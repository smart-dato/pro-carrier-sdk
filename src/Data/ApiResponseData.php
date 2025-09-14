<?php

namespace SmartDato\ProCarrier\Data;

/**
 * API Response Data Transfer Object
 */
class ApiResponseData
{
    /**
     * @param  TrackingEventData[]  $events
     */
    public function __construct(
        public int $errorLevel,
        public string $error = '',
        public string $trackingNumber = '',
        public string $shipperReference = '',
        public string $displayId = '',
        public string $service = '',
        public string $carrier = '',
        public string $carrierTrackingNumber = '',
        public string $carrierLocalTrackingNumber = '',
        public string $carrierTrackingUrl = '',
        public string $labelFormat = '',
        public string $labelType = '',
        public string $labelImage = '',
        public string $labelType2 = '',
        public string $labelImage2 = '',
        public string $carrierId = '',
        public float $weight = 0.0,
        public string $weightUnit = '',
        public ?AddressData $consigneeAddress = null,
        public array $events = [],
        public string $data = '', // Raw response data (for debugging purposes)
    ) {
        $this->consigneeAddress = $consigneeAddress ?? new AddressData('', '', '', '');
    }

    public function isSuccess(): bool
    {
        return $this->errorLevel === 0;
    }

    public function hasErrors(): bool
    {
        return $this->errorLevel === 1;
    }

    public function isFatalError(): bool
    {
        return $this->errorLevel === 10;
    }

    public static function fromArray(array $data, ?string $raw = null): self
    {
        $consigneeAddress = null;
        if (isset($data['Shipment']['ConsigneeAddress'])) {
            $addr = $data['Shipment']['ConsigneeAddress'];
            $consigneeAddress = new AddressData(
                name: $addr['Name'] ?? '',
                addressLine1: $addr['AddressLine1'] ?? '',
                city: $addr['City'] ?? '',
                country: $addr['Country'] ?? '',
                company: $addr['Company'] ?? '',
                zip: $addr['Zip'] ?? '',
                state: $addr['State'] ?? ''
            );
        }

        $events = [];
        if (isset($data['Shipment']['Events'])) {
            $events = array_map(
                fn (array $event) => TrackingEventData::fromArray($event),
                $data['Shipment']['Events']
            );
        }

        $shipment = $data['Shipment'] ?? [];
        $group = $data['Group'] ?? [];

        return new self(
            errorLevel: (int) ($data['ErrorLevel'] ?? 0),
            error: $data['Error'] ?? '',
            trackingNumber: $shipment['TrackingNumber'] ?? '',
            shipperReference: $shipment['ShipperReference'] ?? '',
            displayId: $shipment['DisplayId'] ?? '',
            service: $shipment['Service'] ?? '',
            carrier: $shipment['Carrier'] ?? '',
            carrierTrackingNumber: $shipment['CarrierTrackingNumber'] ?? '',
            carrierLocalTrackingNumber: $shipment['CarrierLocalTrackingNumber'] ?? '',
            carrierTrackingUrl: $shipment['CarrierTrackingUrl'] ?? '',
            labelFormat: $shipment['LabelFormat'] ?? $group['LabelFormat'] ?? '',
            labelType: $shipment['LabelType'] ?? $group['LabelType'] ?? '',
            labelImage: $shipment['LabelImage'] ?? $group['LabelImage'] ?? '',
            labelType2: $shipment['LabelType2'] ?? '',
            labelImage2: $shipment['LabelImage2'] ?? '',
            carrierId: $group['CarrierId'] ?? '',
            weight: (float) ($shipment['Weight'] ?? 0.0),
            weightUnit: $shipment['WeightUnit'] ?? '',
            consigneeAddress: $consigneeAddress,
            events: $events,
            data: $raw,
        );
    }
}
