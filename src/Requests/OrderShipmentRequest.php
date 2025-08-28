<?php

namespace SmartDato\ProCarrier\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;
use SmartDato\ProCarrier\Data\ShipmentData;

/**
 * Order Shipment Request
 */
class OrderShipmentRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected string $apiKey,
        protected ShipmentData $shipmentData
    ) {}

    public function resolveEndpoint(): string
    {
        return '';
    }

    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'text/json',
        ];
    }

    protected function defaultBody(): array
    {
        return [
            'Apikey' => $this->apiKey,
            'Command' => 'OrderShipment',
            'Shipment' => $this->shipmentData->toArray(),
        ];
    }
}
