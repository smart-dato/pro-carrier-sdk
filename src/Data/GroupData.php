<?php

namespace SmartDato\ProCarrier\Data;

/**
 * Parcel Group Data Transfer Object
 */
class GroupData
{
    /**
     * @param  string[]  $trackingNumbers
     */
    public function __construct(
        public array $trackingNumbers,
        public string $labelFormat = 'ZPL300',
        public string $mawbNumber = '',
        public string $mawbDate = '',
        public string $flightId = '',
        public string $arrivalDate = '',
        public string $arrivalTime = ''
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'LabelFormat' => $this->labelFormat,
            'MawbNumber' => $this->mawbNumber,
            'MawbDate' => $this->mawbDate,
            'FlightId' => $this->flightId,
            'ArrivalDate' => $this->arrivalDate,
            'ArrivalTime' => $this->arrivalTime,
            'TrackingNumbers' => $this->trackingNumbers,
        ], fn ($value) => $value !== '' && $value !== []);
    }
}
