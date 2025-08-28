<?php

namespace SmartDato\ProCarrier\Builders;

use SmartDato\ProCarrier\Data\AddressData;

/**
 * Address Builder
 */
class AddressBuilder
{
    private string $name = '';

    private string $addressLine1 = '';

    private string $city = '';

    private string $country = '';

    private string $phone = '';

    private string $email = '';

    private string $company = '';

    private string $addressLine2 = '';

    private string $addressLine3 = '';

    private string $state = '';

    private string $zip = '';

    private string $vat = '';

    private string $eori = '';

    private string $ioss = '';

    private string $taxId = '';

    private string $pudoLocationId = '';

    public static function create(): self
    {
        return new self;
    }

    public function name(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function company(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function addressLine1(string $addressLine1): self
    {
        $this->addressLine1 = $addressLine1;

        return $this;
    }

    public function addressLine2(string $addressLine2): self
    {
        $this->addressLine2 = $addressLine2;

        return $this;
    }

    public function addressLine3(string $addressLine3): self
    {
        $this->addressLine3 = $addressLine3;

        return $this;
    }

    public function city(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function state(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function zip(string $zip): self
    {
        $this->zip = $zip;

        return $this;
    }

    public function country(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function phone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function email(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function vat(string $vat): self
    {
        $this->vat = $vat;

        return $this;
    }

    public function eori(string $eori): self
    {
        $this->eori = $eori;

        return $this;
    }

    public function ioss(string $ioss): self
    {
        $this->ioss = $ioss;

        return $this;
    }

    public function taxId(string $taxId): self
    {
        $this->taxId = $taxId;

        return $this;
    }

    public function pudoLocationId(string $pudoLocationId): self
    {
        $this->pudoLocationId = $pudoLocationId;

        return $this;
    }

    public function build(): AddressData
    {
        return new AddressData(
            name: $this->name,
            addressLine1: $this->addressLine1,
            city: $this->city,
            country: $this->country,
            phone: $this->phone,
            email: $this->email,
            company: $this->company,
            addressLine2: $this->addressLine2,
            addressLine3: $this->addressLine3,
            state: $this->state,
            zip: $this->zip,
            vat: $this->vat,
            eori: $this->eori,
            ioss: $this->ioss,
            taxId: $this->taxId,
            pudoLocationId: $this->pudoLocationId
        );
    }
}
