<?php

namespace SmartDato\ProCarrier\Builders;

use SmartDato\ProCarrier\Data\GroupData;

/**
 * Group Builder
 */
class GroupBuilder
{
    private array $trackingNumbers = [];

    private string $labelFormat = 'ZPL300';

    private string $mawbNumber = '';

    private string $mawbDate = '';

    private string $flightId = '';

    private string $arrivalDate = '';

    private string $arrivalTime = '';

    public static function create(): self
    {
        return new self;
    }

    public function trackingNumbers(array $trackingNumbers): self
    {
        $this->trackingNumbers = $trackingNumbers;

        return $this;
    }

    public function addTrackingNumber(string $trackingNumber): self
    {
        $this->trackingNumbers[] = $trackingNumber;

        return $this;
    }

    public function labelFormat(string $labelFormat): self
    {
        $this->labelFormat = $labelFormat;

        return $this;
    }

    public function mawb(string $number, string $date = ''): self
    {
        $this->mawbNumber = $number;
        $this->mawbDate = $date;

        return $this;
    }

    public function flight(string $flightId, string $arrivalDate = '', string $arrivalTime = ''): self
    {
        $this->flightId = $flightId;
        $this->arrivalDate = $arrivalDate;
        $this->arrivalTime = $arrivalTime;

        return $this;
    }

    public function build(): GroupData
    {
        return new GroupData(
            trackingNumbers: $this->trackingNumbers,
            labelFormat: $this->labelFormat,
            mawbNumber: $this->mawbNumber,
            mawbDate: $this->mawbDate,
            flightId: $this->flightId,
            arrivalDate: $this->arrivalDate,
            arrivalTime: $this->arrivalTime
        );
    }
}
