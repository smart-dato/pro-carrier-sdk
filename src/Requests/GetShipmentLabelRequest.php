<?php

namespace SmartDato\ProCarrier\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Get Shipment Label Request
 */
class GetShipmentLabelRequest extends Request  implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected string $apiKey,
        protected string $trackingNumber = '',
        protected string $shipperReference = '',
        protected string $labelFormat = 'PDF',
        protected string $labelOption = 'System'
    ) {}

    public function resolveEndpoint(): string
    {
        return '';
    }

    protected function defaultBody(): array
    {
        return [
            'Apikey' => $this->apiKey,
            'Command' => 'GetShipmentLabel',
            'Shipment' => array_filter([
                'TrackingNumber' => $this->trackingNumber,
                'ShipperReference' => $this->shipperReference,
                'LabelFormat' => $this->labelFormat,
                'LabelOption' => $this->labelOption,
            ]),
        ];
    }
}
