<?php

namespace SmartDato\ProCarrier\Builders;

use SmartDato\ProCarrier\Data\AddressData;
use SmartDato\ProCarrier\Data\ProductData;
use SmartDato\ProCarrier\Data\ShipmentData;
use SmartDato\ProCarrier\Enums\ServiceCode;

/**
 * Shipment Builder
 */
class ShipmentBuilder
{
    private AddressData $senderAddress;

    private AddressData $consigneeAddress;

    private array $products = [];

    private ?ServiceCode $service = null;

    private float $weight = 0.0;

    private string $weightUnit = 'kg';

    private float $length = 0.0;

    private float $width = 0.0;

    private float $height = 0.0;

    private string $dimUnit = 'cm';

    private float $value = 0.0;

    private string $currency = 'USD';

    private string $description = '';

    private string $declarationType = 'SaleOfGoods';

    private string $customsDuty = 'DDP';

    private bool $requireCarrierTrackingNumber = true;

    private string $labelOption = 'System';

    private string $labelFormat = 'PDF';

    private string $trackingNumber = '';

    private string $shipperReference = '';

    private string $displayId = '';

    private string $invoiceNumber = '';

    private string $basketId = '';

    private string $deliveryInstructions = '';

    private string $orderDate = '';

    public function __construct()
    {
        // Initialize with empty addresses
        $this->senderAddress = new AddressData('', '', '', '');
        $this->consigneeAddress = new AddressData('', '', '', '');
    }

    public static function create(): self
    {
        return new self;
    }

    public function senderAddress(AddressData $address): self
    {
        $this->senderAddress = $address;

        return $this;
    }

    public function consigneeAddress(AddressData $address): self
    {
        $this->consigneeAddress = $address;

        return $this;
    }

    public function addProduct(ProductData $product): self
    {
        $this->products[] = $product;

        return $this;
    }

    public function products(array $products): self
    {
        $this->products = $products;

        return $this;
    }

    public function service(ServiceCode $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function weight(float $weight, string $unit = 'kg'): self
    {
        $this->weight = $weight;
        $this->weightUnit = $unit;

        return $this;
    }

    public function dimensions(float $length, float $width, float $height, string $unit = 'cm'): self
    {
        $this->length = $length;
        $this->width = $width;
        $this->height = $height;
        $this->dimUnit = $unit;

        return $this;
    }

    public function value(float $value, string $currency = 'USD'): self
    {
        $this->value = $value;
        $this->currency = $currency;

        return $this;
    }

    public function description(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function declarationType(string $declarationType): self
    {
        $this->declarationType = $declarationType;

        return $this;
    }

    public function customsDuty(string $customsDuty): self
    {
        $this->customsDuty = $customsDuty;

        return $this;
    }

    public function requireCarrierTrackingNumber(bool $require = true): self
    {
        $this->requireCarrierTrackingNumber = $require;

        return $this;
    }

    public function labelOptions(string $option = 'System', string $format = 'PDF'): self
    {
        $this->labelOption = $option;
        $this->labelFormat = $format;

        return $this;
    }

    public function references(string $shipperReference = '', string $displayId = '', string $invoiceNumber = ''): self
    {
        $this->shipperReference = $shipperReference;
        $this->displayId = $displayId;
        $this->invoiceNumber = $invoiceNumber;

        return $this;
    }

    public function basketId(string $basketId): self
    {
        $this->basketId = $basketId;

        return $this;
    }

    public function deliveryInstructions(string $instructions): self
    {
        $this->deliveryInstructions = $instructions;

        return $this;
    }

    public function orderDate(string $orderDate): self
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    public function build(): ShipmentData
    {
        return new ShipmentData(
            senderAddress: $this->senderAddress,
            consigneeAddress: $this->consigneeAddress,
            products: $this->products,
            service: $this->service ?? ServiceCode::PRO_CARRIER_UK_48,
            weight: $this->weight,
            weightUnit: $this->weightUnit,
            length: $this->length,
            width: $this->width,
            height: $this->height,
            dimUnit: $this->dimUnit,
            value: $this->value,
            currency: $this->currency,
            description: $this->description,
            declarationType: $this->declarationType,
            customsDuty: $this->customsDuty,
            requireCarrierTrackingNumber: $this->requireCarrierTrackingNumber,
            labelOption: $this->labelOption,
            labelFormat: $this->labelFormat,
            trackingNumber: $this->trackingNumber,
            shipperReference: $this->shipperReference,
            displayId: $this->displayId,
            invoiceNumber: $this->invoiceNumber,
            basketId: $this->basketId,
            deliveryInstructions: $this->deliveryInstructions,
            orderDate: $this->orderDate
        );
    }
}
