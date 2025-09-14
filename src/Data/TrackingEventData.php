<?php

namespace SmartDato\ProCarrier\Data;

/**
 * Tracking Event Data Transfer Object
 */
class TrackingEventData
{
    public function __construct(
        public string $dateTime,

        public string $country,
        public string $code,
        public string $description,
        public string $carrierCode = '',
        public string $carrierDescription = ''
    ) {}

    public function toArray(): array
    {
        return [
            'DateTime' => $this->dateTime,
            'Country' => $this->country,
            'Code' => $this->code,
            'Description' => $this->description,
            'CarrierCode' => $this->carrierCode,
            'CarrierDescription' => $this->carrierDescription,
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            dateTime: $data['DateTime'] ?? '',
            country: $data['Country'] ?? '',
            code: $data['Code'] ?? '',
            description: $data['Description'] ?? '',
            carrierCode: $data['CarrierCode'] ?? '',
            carrierDescription: $data['CarrierDescription'] ?? ''
        );
    }
}
