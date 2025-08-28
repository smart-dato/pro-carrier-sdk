<?php

namespace SmartDato\ProCarrier\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Void Shipment Request
 */
class VoidShipmentRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected string $apiKey,
        protected string $trackingNumber = '',
        protected string $shipperReference = ''
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '';
    }

    protected function defaultBody(): array
    {
        return [
            'Apikey' => $this->apiKey,
            'Command' => 'VoidShipment',
            'Shipment' => array_filter([
                'TrackingNumber' => $this->trackingNumber,
                'ShipperReference' => $this->shipperReference,
            ]),
        ];
    }
}
