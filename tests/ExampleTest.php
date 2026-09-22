<?php

use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use SmartDato\ProCarrier\Builders\AddressBuilder;
use SmartDato\ProCarrier\Builders\GroupBuilder;
use SmartDato\ProCarrier\Builders\ProductBuilder;
use SmartDato\ProCarrier\Builders\ShipmentBuilder;
use SmartDato\ProCarrier\Enums\ServiceCode;
use SmartDato\ProCarrier\ProCarrier;
use SmartDato\ProCarrier\Requests\CreateParcelGroupRequest;
use SmartDato\ProCarrier\Requests\OrderShipmentRequest;

beforeEach(function () {
    MockClient::global([
        OrderShipmentRequest::class => MockResponse::make([
            'ErrorLevel' => 0,
            'Shipment' => [
                'TrackingNumber' => 'DG32733000013',
                'ShipperReference' => 'LaravelPlugin - ProCarrier',
                'DisplayId' => 'PC-0001',
                'Service' => 'PPTT',
                'Carrier' => 'Pro Carrier',
                'CarrierTrackingNumber' => 'CT0000000001',
                'CarrierTrackingUrl' => 'https://track.example/CT0000000001',
                'LabelFormat' => 'PDF',
                'LabelType' => 'System',
                'LabelImage' => base64_encode('%PDF-1.4 fake label'),
                'Weight' => 0.413,
                'WeightUnit' => 'kg',
            ],
        ], 200),
        CreateParcelGroupRequest::class => MockResponse::make([
            'ErrorLevel' => 0,
            'Group' => [
                'CarrierId' => 'GRP-0001',
                'LabelFormat' => 'PDF',
                'LabelType' => 'System',
                'LabelImage' => base64_encode('%PDF-1.4 fake manifest'),
            ],
        ], 200),
    ]);

    $this->service = new ProCarrier('test-api-key', true);
});

afterEach(function () {
    MockClient::destroyGlobal();
});

it('Parcel#1 - Robin Bassford (US)', function () {
    $senderAddress = AddressBuilder::create()
        ->name('Pro Carrier')
        ->addressLine1('UNIT 1 JUNIPER PARK,Fenton Way')
        ->city('Basildon')
        ->zip('SS15 6RZ')
        ->country('GB')
        ->phone('07000000000')
        ->vat('916588487')
        ->eori('GB916588487001 ')
        ->ioss('IM3720015006')
        ->build();

    $consigneeAddress = AddressBuilder::create()
        ->name('Robin Bassford')
        ->addressLine1('56 South Fork Road')
        ->city('Garden Valley')
        ->state('ID')
        ->zip('83622')
        ->country('US')
        ->phone('+12065500269')
        ->email('robin.denison@moneytreeinc.com')
        ->vat(' 916588487')
        ->build();

    $product1 = ProductBuilder::create()
        ->description('Acle WR Nano Fleece Glove M Navy')
        ->sku('12100121000420')
        ->hsCode('6216000000')
        ->originCountry('CN')
        ->quantity(1)
        ->value(52.50)
        ->midCode('CNSU154SU')
        ->manufacturer(
            code: '123',
            company: 'Suzhou Longxin Gloves Co Ltd',
            address1: 'UNIT 1 JUNIPER PARK,Fenton Way',
            zip: '0000',
            city: 'Suzhou',
            state: 'Jiangsu',
            country: 'CN'
        )
        ->build();

    $product2 = ProductBuilder::create()
        ->description('Marsham Waterproof Cold Weather Reflective Cycle Glove')
        ->sku('12124069000120')
        ->hsCode('6216000000')
        ->originCountry('CN')
        ->quantity(1)
        ->value(135.00)
        ->midCode('CNSP9777SH')
        ->manufacturer(
            code: '123',
            company: 'Sports Pro/Mietie Group',
            address1: 'SportzPro',
            zip: '201700',
            city: 'Shanghai',
            state: 'Shanghai',
            country: 'CN'
        )
        ->build();

    $shipment = ShipmentBuilder::create()
        ->senderAddress($senderAddress)
        ->consigneeAddress($consigneeAddress)
        ->addProduct($product1)
        ->addProduct($product2)
        ->service(ServiceCode::PRO_CARRIER_PLUS)
        ->weight(0.413, 'kg')
        ->dimensions(55.0, 45.0, 5.0, 'cm')
        ->value(277.50, 'USD')
        ->description('Acle WR Nano Fleece Glove M Navy')
        ->customsDuty('DDP')
        ->declarationType('SaleOfGoods')
        ->references('LaravelPlugin - ProCarrier - OmestParcel#1 - '.Str::uuid()->toString())
        ->requireCarrierTrackingNumber(true)
        ->labelOptions('System', 'PDF')
        ->build();

    $response = $this->service->createShipment($shipment);

    expect($response->isSuccess())->toBeTrue()
        ->and($response->trackingNumber)->toBe('DG32733000013')
        ->and($response->carrier)->toBe('Pro Carrier')
        ->and($response->labelFormat)->toBe('PDF')
        ->and(base64_decode($response->labelImage))->toStartWith('%PDF');
});

it('Parcel#2 - Hilton Guam Resort & Spa (Guam)', function () {
    $senderAddress = AddressBuilder::create()
        ->name('Pro Carrier')
        ->company('Pro carrier')
        ->addressLine1('UNIT 1 JUNIPER PARK,Fenton Way')
        ->city('Basildon')
        ->zip('SS15 6RZ')
        ->country('GB')
        ->phone('07000000000')
        ->vat('916588487')
        ->eori('GB916588487001 ')
        ->ioss('IM3720015006')
        ->build();

    $consigneeAddress = AddressBuilder::create()
        ->name('Hilton Guam Resort & Spa')
        ->addressLine1('202 Hilton Road')
        ->city('Tumon Bay')
        ->state('GUAM')
        ->zip('96913')
        ->country('GU')
        ->phone('9145887665')
        ->email('whayes10@optimum.net')
        ->vat(' 916588487')
        ->build();

    $product1 = ProductBuilder::create()
        ->description('Anmer Waterproof All Weather Ultra Grip Knitted Glove')
        ->sku('12124082000130')
        ->hsCode('6116990000')
        ->originCountry('CN')
        ->quantity(1)
        ->value(155.00)
        ->midCode('CNSH1501SH')
        ->manufacturer(
            code: '123',
            company: 'MountPeak Co',
            address1: 'Mountpeak Co Ltd, No.7 Shi Lan Road',
            zip: '0000',
            city: 'GuangZhou',
            state: 'Guang Dong',
            country: 'CN'
        )
        ->build();

    $product2 = ProductBuilder::create()
        ->description('Howe Waterproof All Weather Multi-Activity Glove With Fusion Control')
        ->sku('12124105000330')
        ->hsCode('6216000000')
        ->originCountry('CN')
        ->quantity(1)
        ->value(250.00)
        ->midCode('GBSE36KI')
        ->manufacturer(
            code: '123',
            company: 'Shanghai Rocky (intl Business)',
            address1: 'Shanghai Rocky, Development Co Ltd',
            zip: '0000',
            city: 'Shanghai',
            state: 'Shanghai',
            country: 'CN'
        )
        ->build();

    $shipment = ShipmentBuilder::create()
        ->senderAddress($senderAddress)
        ->consigneeAddress($consigneeAddress)
        ->addProduct($product1)
        ->addProduct($product2)
        ->service(ServiceCode::PRO_CARRIER_PLUS)
        ->weight(0.457, 'kg')
        ->dimensions(55.0, 45.0, 5.0, 'cm')
        ->value(470.00, 'USD')
        ->description('Anmer Waterproof All Weather Ultra Grip Knitted Glove')
        ->customsDuty('DDP')
        ->declarationType('SaleOfGoods')
        ->references('LaravelPlugin - ProCarrier - OmestParcel#2 - '.Str::uuid()->toString())
        ->requireCarrierTrackingNumber(true)
        ->labelOptions('System', 'PDF')
        ->build();

    $response = $this->service->createShipment($shipment);

    expect($response->isSuccess())->toBeTrue()
        ->and($response->weight)->toBe(0.413)
        ->and($response->weightUnit)->toBe('kg');
});

it('Parcel#3 - Kensington Hotel Saipan (Northern Mariana Islands)', function () {
    $senderAddress = AddressBuilder::create()
        ->name('Pro Carrier')
        ->addressLine1('UNIT 1 JUNIPER PARK,Fenton Way')
        ->city('Basildon')
        ->zip('SS15 6RZ')
        ->country('GB')
        ->phone('07000000000')
        ->vat('916588487')
        ->eori('GB916588487001 ')
        ->ioss('IM3720015006')
        ->build();

    $consigneeAddress = AddressBuilder::create()
        ->name('Kensington Hotel Saipan')
        ->addressLine1('Paupau Beach, San Roque')
        ->city('Saipan')
        ->state('MP')
        ->zip('96950')
        ->country('MP')
        ->phone('9145887665')
        ->email('whayes10@optimum.net')
        ->vat(' 916588487')
        ->build();

    $product1 = ProductBuilder::create()
        ->description('Beetley WP AW Head Gaitor L/XL Black')
        ->sku('16123031000135')
        ->hsCode('65050090')
        ->originCountry('CN')
        ->quantity(1)
        ->value(45.00)
        ->midCode('CNSH1501SH')
        ->manufacturer(
            code: '123',
            company: 'MountPeak Co',
            address1: 'Mountpeak Co Ltd, No.7 Shi Lan Road',
            zip: '0000',
            city: 'GuangZhou',
            state: 'Guang Dong',
            country: 'CN'
        )
        ->build();

    $product2 = ProductBuilder::create()
        ->description('Cley WP CW Beanie L/XL Green')
        ->sku('13100031000335')
        ->hsCode('65050090')
        ->originCountry('CN')
        ->quantity(1)
        ->value(45.00)
        ->midCode('CNSH1501SH')
        ->manufacturer(
            code: '123',
            company: 'Jorg 2915 Ltd',
            address1: 'Jorg 2915 Ltd',
            zip: '0000',
            city: 'Bulgaria',
            state: 'Bulgaria',
            country: 'BG'
        )
        ->build();

    $shipment = ShipmentBuilder::create()
        ->senderAddress($senderAddress)
        ->consigneeAddress($consigneeAddress)
        ->addProduct($product1)
        ->addProduct($product2)
        ->service(ServiceCode::PRO_CARRIER_PLUS)
        ->weight(0.395, 'kg')
        ->dimensions(55.0, 45.0, 5.0, 'cm')
        ->value(159.00, 'USD')
        ->description('Beetley WP AW Head Gaitor L/XL Black')
        ->customsDuty('DDP')
        ->declarationType('SaleOfGoods')
        ->references('LaravelPlugin - ProCarrier - OmestParcel#3 - '.Str::uuid()->toString())
        ->requireCarrierTrackingNumber(true)
        ->labelOptions('System', 'PDF')
        ->build();

    $response = $this->service->createShipment($shipment);

    expect($response->isSuccess())->toBeTrue()
        ->and($response->carrierTrackingNumber)->toBe('CT0000000001');
});

it('create parel group', function () {
    $response = $this->service->createParcelGroup(GroupBuilder::create()
        ->addTrackingNumber('DG32733000013')
//        ->addTrackingNumber('DG46666000162')
        ->labelFormat('PDF')
        ->build());

    expect($response->isSuccess())->toBeTrue()
        ->and($response->carrierId)->toBe('GRP-0001')
        ->and($response->labelFormat)->toBe('PDF');
});
