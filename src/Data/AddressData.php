<?php

namespace SmartDato\ProCarrier\Data;

/**
 * Address Data Transfer Object
 */
class AddressData
{
    public function __construct(
        public string $name,
        public string $addressLine1,
        public string $city,
        public string $country,
        public string $phone = '',
        public string $email = '',
        public string $company = '',
        public string $addressLine2 = '',
        public string $addressLine3 = '',
        public string $state = '',
        public string $zip = '',
        public string $vat = '',
        public string $eori = '',
        public string $ioss = '',
        public string $taxId = '',
        public string $pudoLocationId = ''
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'Name' => $this->name,
            'Company' => $this->company,
            'AddressLine1' => $this->addressLine1,
            'AddressLine2' => $this->addressLine2,
            'AddressLine3' => $this->addressLine3,
            'City' => $this->city,
            'State' => $this->state,
            'Zip' => $this->zip,
            'Country' => $this->country,
            'Phone' => $this->phone,
            'Email' => $this->email,
            'Vat' => $this->vat,
            'Eori' => $this->eori,
            'Ioss' => $this->ioss,
            'TaxId' => $this->taxId,
            'PudoLocationId' => $this->pudoLocationId,
        ], fn ($value) => $value !== '');
    }
}
