<?php

namespace SmartDato\ProCarrier\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Get Shipment Invoice Request
 */
class GetShipmentInvoiceRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected string $apiKey,
        protected string $trackingNumber = '',
        protected string $shipperReference = '',
        protected string $labelFormat = 'PDF'
    ) {}

    public function resolveEndpoint(): string
    {
        return '';
    }

    protected function defaultBody(): array
    {
        return [
            'Apikey' => $this->apiKey,
            'Command' => 'GetShipmentInvoice',
            'Shipment' => array_filter([
                'TrackingNumber' => $this->trackingNumber,
                'ShipperReference' => $this->shipperReference,
                'LabelFormat' => $this->labelFormat,
            ]),
        ];
    }
}
