<?php

namespace SmartDato\ProCarrier\Builders;

use SmartDato\ProCarrier\Data\ProductData;

/**
 * Product Builder
 */
class ProductBuilder
{
    private string $description = '';

    private string $hsCode = '';

    private string $originCountry = '';

    private int $quantity = 1;

    private float $value = 0.0;

    private string $sku = '';

    private string $purchaseUrl = '';

    private string $midCode = '';

    private string $manufacturerCode = '';

    private string $manufacturerCompany = '';

    private string $manufacturerAddress1 = '';

    private string $manufacturerAddress2 = '';

    private string $manufacturerAddress3 = '';

    private string $manufacturerZip = '';

    private string $manufacturerCity = '';

    private string $manufacturerState = '';

    private string $manufacturerCountry = '';

    private string $imgUrl = '';

    private string $nonReturnable = '';

    private int $daysForReturn = 0;

    private float $weight = 0.0;

    private string $weightUnit = 'kg';

    public static function create(): self
    {
        return new self;
    }

    public function description(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function sku(string $sku): self
    {
        $this->sku = $sku;

        return $this;
    }

    public function hsCode(string $hsCode): self
    {
        $this->hsCode = $hsCode;

        return $this;
    }

    public function originCountry(string $originCountry): self
    {
        $this->originCountry = $originCountry;

        return $this;
    }

    public function quantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function value(float $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function purchaseUrl(string $purchaseUrl): self
    {
        $this->purchaseUrl = $purchaseUrl;

        return $this;
    }

    public function midCode(string $midCode): self
    {
        $this->midCode = $midCode;

        return $this;
    }

    public function manufacturer(
        string $code = '',
        string $company = '',
        string $address1 = '',
        string $address2 = '',
        string $address3 = '',
        string $zip = '',
        string $city = '',
        string $state = '',
        string $country = ''
    ): self {
        $this->manufacturerCode = $code;
        $this->manufacturerCompany = $company;
        $this->manufacturerAddress1 = $address1;
        $this->manufacturerAddress2 = $address2;
        $this->manufacturerAddress3 = $address3;
        $this->manufacturerZip = $zip;
        $this->manufacturerCity = $city;
        $this->manufacturerState = $state;
        $this->manufacturerCountry = $country;

        return $this;
    }

    public function imgUrl(string $imgUrl): self
    {
        $this->imgUrl = $imgUrl;

        return $this;
    }

    public function nonReturnable(bool $nonReturnable = true): self
    {
        $this->nonReturnable = $nonReturnable ? 'Y' : 'N';

        return $this;
    }

    public function daysForReturn(int $daysForReturn): self
    {
        $this->daysForReturn = $daysForReturn;

        return $this;
    }

    public function weight(float $weight, string $unit = 'kg'): self
    {
        $this->weight = $weight;
        $this->weightUnit = $unit;

        return $this;
    }

    public function build(): ProductData
    {
        return new ProductData(
            description: $this->description,
            hsCode: $this->hsCode,
            originCountry: $this->originCountry,
            quantity: $this->quantity,
            value: $this->value,
            sku: $this->sku,
            purchaseUrl: $this->purchaseUrl,
            midCode: $this->midCode,
            manufacturerCode: $this->manufacturerCode,
            manufacturerCompany: $this->manufacturerCompany,
            manufacturerAddress1: $this->manufacturerAddress1,
            manufacturerAddress2: $this->manufacturerAddress2,
            manufacturerAddress3: $this->manufacturerAddress3,
            manufacturerZip: $this->manufacturerZip,
            manufacturerCity: $this->manufacturerCity,
            manufacturerState: $this->manufacturerState,
            manufacturerCountry: $this->manufacturerCountry,
            imgUrl: $this->imgUrl,
            nonReturnable: $this->nonReturnable,
            daysForReturn: $this->daysForReturn,
            weight: $this->weight,
            weightUnit: $this->weightUnit
        );
    }
}
