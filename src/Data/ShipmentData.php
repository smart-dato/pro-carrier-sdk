<?php

namespace SmartDato\ProCarrier\Data;

use SmartDato\ProCarrier\Enums\ServiceCode;

/**
 * Shipment Data Transfer Object
 */
class ShipmentData
{
    /**
     * @param  ProductData[]  $products
     */
    public function __construct(
        public AddressData $senderAddress,
        public AddressData $consigneeAddress,
        public array $products,
        public ServiceCode $service,
        public float $weight,
        public string $weightUnit = 'kg',
        public float $length = 0.0,
        public float $width = 0.0,
        public float $height = 0.0,
        public string $dimUnit = 'cm',
        public float $value = 0.0,
        public string $currency = 'USD',
        public string $description = '',
        public string $declarationType = 'SaleOfGoods',
        public string $customsDuty = 'DDP',
        public bool $requireCarrierTrackingNumber = true,
        public string $labelOption = 'System',
        public string $labelFormat = 'PDF',
        public string $trackingNumber = '',
        public string $shipperReference = '',
        public string $displayId = '',
        public string $invoiceNumber = '',
        public string $basketId = '',
        public string $deliveryInstructions = '',
        public string $orderDate = ''
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'RequireCarrierTrackingNumber' => $this->requireCarrierTrackingNumber,
            'LabelOption' => $this->labelOption,
            'LabelFormat' => $this->labelFormat,
            'TrackingNumber' => $this->trackingNumber,
            'ShipperReference' => $this->shipperReference,
            'DisplayId' => $this->displayId,
            'InvoiceNumber' => $this->invoiceNumber,
            'Service' => $this->service->value,
            'BasketId' => $this->basketId,
            'OrderDate' => $this->orderDate,
            'SenderAddress' => $this->senderAddress->toArray(),
            'ConsigneeAddress' => $this->consigneeAddress->toArray(),
            'Weight' => $this->weight,
            'WeightUnit' => $this->weightUnit,
            'Length' => $this->length > 0 ? $this->length : null,
            'Width' => $this->width > 0 ? $this->width : null,
            'Height' => $this->height > 0 ? $this->height : null,
            'DimUnit' => $this->dimUnit,
            'Value' => $this->value,
            'Currency' => $this->currency,
            'CustomsDuty' => $this->customsDuty,
            'Description' => $this->description,
            'DeclarationType' => $this->declarationType,
            'DeliveryInstructions' => $this->deliveryInstructions,
            'Products' => array_map(fn (ProductData $product) => $product->toArray(), $this->products),
        ], fn ($value) => $value !== '' && $value !== null);
    }
}
