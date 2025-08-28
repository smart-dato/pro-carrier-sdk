<?php

namespace SmartDato\ProCarrier\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Cancel Parcel Group Request
 */
class CancelParcelGroupRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected string $apiKey,
        protected string $carrierId
    ) {}

    public function resolveEndpoint(): string
    {
        return '';
    }

    protected function defaultBody(): array
    {
        return [
            'Apikey' => $this->apiKey,
            'Command' => 'CancelGroup',
            'Group' => [
                'CarrierId' => $this->carrierId,
            ],
        ];
    }
}
