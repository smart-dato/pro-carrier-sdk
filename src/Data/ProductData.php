<?php

namespace SmartDato\ProCarrier\Data;

/**
 * Product Data Transfer Object
 */
class ProductData
{
    public function __construct(
        public string $description,
        public string $hsCode,
        public string $originCountry,
        public int $quantity,
        public float $value,
        public string $sku = '',
        public string $purchaseUrl = '',
        public string $midCode = '',
        public string $manufacturerCode = '',
        public string $manufacturerCompany = '',
        public string $manufacturerAddress1 = '',
        public string $manufacturerAddress2 = '',
        public string $manufacturerAddress3 = '',
        public string $manufacturerZip = '',
        public string $manufacturerCity = '',
        public string $manufacturerState = '',
        public string $manufacturerCountry = '',
        public string $imgUrl = '',
        public string $nonReturnable = '',
        public int $daysForReturn = 0,
        public float $weight = 0.0,
        public string $weightUnit = 'kg'
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'Description' => $this->description,
            'Sku' => $this->sku,
            'HsCode' => $this->hsCode,
            'OriginCountry' => $this->originCountry,
            'PurchaseUrl' => $this->purchaseUrl,
            'Quantity' => $this->quantity,
            'Value' => $this->value,
            'MidCode' => $this->midCode,
            'ManufacturerCode' => $this->manufacturerCode,
            'ManufacturerCompany' => $this->manufacturerCompany,
            'ManufacturerAddress1' => $this->manufacturerAddress1,
            'ManufacturerAddress2' => $this->manufacturerAddress2,
            'ManufacturerAddress3' => $this->manufacturerAddress3,
            'ManufacturerZip' => $this->manufacturerZip,
            'ManufacturerCity' => $this->manufacturerCity,
            'ManufacturerState' => $this->manufacturerState,
            'ManufacturerCountry' => $this->manufacturerCountry,
            'ImgUrl' => $this->imgUrl,
            'NonReturnable' => $this->nonReturnable,
            'DaysForReturn' => $this->daysForReturn > 0 ? $this->daysForReturn : null,
            'Weight' => $this->weight > 0 ? $this->weight : null,
            'WeightUnit' => $this->weightUnit,
        ], fn ($value) => $value !== '' && $value !== null);
    }
}
