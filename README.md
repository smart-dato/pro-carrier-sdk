# Pro Carrier SDK

[![Latest Version on Packagist](https://img.shields.io/packagist/v/smart-dato/pro-carrier-sdk.svg?style=flat-square)](https://packagist.org/packages/smart-dato/pro-carrier-sdk)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/smart-dato/pro-carrier-sdk/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/smart-dato/pro-carrier-sdk/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/smart-dato/pro-carrier-sdk/code-style.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/smart-dato/pro-carrier-sdk/actions?query=workflow%3A%22Code+style%22+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/smart-dato/pro-carrier-sdk.svg?style=flat-square)](https://packagist.org/packages/smart-dato/pro-carrier-sdk)

A Laravel package for the Pro Carrier shipping API, built on [Saloon](https://docs.saloon.dev). Create shipments, fetch labels and invoices, track and void parcels, and manage parcel groups through fluent builders.

## Requirements

- PHP 8.2+
- Laravel 10 – 13

## Installation

```bash
composer require smart-dato/pro-carrier-sdk
```

Publish the config file:

```bash
php artisan vendor:publish --tag="pro-carrier-sdk-config"
```

## Configuration

```dotenv
PRO_CARRIER_API_KEY=your-api-key
PRO_CARRIER_BASE_URL=https://dgapi.app/API/
PRO_CARRIER_TIMEOUT=30
```

## Usage

```php
use SmartDato\ProCarrier\ProCarrier;

$proCarrier = new ProCarrier();                          // API key from config
$proCarrier = new ProCarrier('your-api-key', testMode: true); // or explicitly
```

The `ProCarrier` facade resolves the same class with the configured API key.

> **Test mode:** pass `testMode: true` to the constructor. The config also defines `PRO_CARRIER_TEST_MODE`, but `ProCarrier` currently always passes its own `testMode` argument to the connector, so that setting has no effect unless you use `ProCarrierConnector` directly.

### Create a shipment

```php
use SmartDato\ProCarrier\Builders\AddressBuilder;
use SmartDato\ProCarrier\Builders\ProductBuilder;
use SmartDato\ProCarrier\Builders\ShipmentBuilder;
use SmartDato\ProCarrier\Enums\ServiceCode;

$sender = AddressBuilder::create()
    ->name('Sender Ltd')
    ->addressLine1('1 High Street')
    ->city('London')
    ->zip('SW1A 1AA')
    ->country('GB')
    ->build();

$consignee = AddressBuilder::create()
    ->name('Jane Doe')
    ->addressLine1('100 Main Street')
    ->city('New York')
    ->state('NY')
    ->zip('10001')
    ->country('US')
    ->phone('+1 212 000 0000')
    ->email('jane@example.com')
    ->build();

$product = ProductBuilder::create()
    ->description('Fleece gloves')
    ->sku('GLOVE-M')
    ->hsCode('611692')
    ->originCountry('CN')
    ->quantity(1)
    ->value(25.00)
    ->build();

$shipment = ShipmentBuilder::create()
    ->senderAddress($sender)
    ->consigneeAddress($consignee)
    ->addProduct($product)
    ->service(ServiceCode::PRO_CARRIER_PLUS)
    ->weight(0.4, 'kg')
    ->dimensions(30.0, 20.0, 5.0, 'cm')
    ->value(25.00, 'USD')
    ->description('Fleece gloves')
    ->references('order-1001')
    ->labelOptions('System', 'PDF')
    ->build();

$response = $proCarrier->createShipment($shipment);

$response->trackingNumber;
$response->carrierTrackingNumber;
base64_decode($response->labelImage); // the label, in the requested format
```

`ServiceCode` enumerates the 55 available services (Yodel, Xpect, Xpress and more).

### Labels, invoices, tracking and voids

Each takes a tracking number or your shipper reference:

```php
$proCarrier->getShipmentLabel(trackingNumber: 'DG32733000013', labelFormat: 'PDF');
$proCarrier->getShipmentInvoice(trackingNumber: 'DG32733000013');
$proCarrier->trackShipment(trackingNumber: 'DG32733000013');
$proCarrier->voidShipment(shipperReference: 'order-1001');
```

### Parcel groups

```php
use SmartDato\ProCarrier\Builders\GroupBuilder;

$group = $proCarrier->createParcelGroup(
    GroupBuilder::create()
        ->addTrackingNumber('DG32733000013')
        ->labelFormat('PDF')
        ->build()
);

$proCarrier->cancelParcelGroup($group->carrierId);
```

### Responses and errors

Every method returns an `ApiResponseData`, with `isSuccess()`, `hasErrors()` and `isFatalError()` helpers alongside the parsed fields.

An error reported by the API raises `ProCarrierException`. Transport and decoding failures raise `ProCarrierFatalRequestException`, `ProCarrierRequestException` or `ProCarrierJsonRequestException`.

## Testing

```bash
composer test
```

The suite mocks the API with Saloon's `MockClient`, so it needs no credentials or network access.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [SmartDato](https://github.com/smart-dato)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
