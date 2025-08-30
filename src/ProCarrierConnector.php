<?php

namespace SmartDato\ProCarrier;

use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;

/**
 * Pro Carrier API Connector
 */
class ProCarrierConnector extends Connector
{
    use AcceptsJson;

    protected bool $testMode;

    private string $url;

    public function __construct(?bool $testMode = null, ?string $url = null)
    {
        $this->testMode = $testMode ?? config('pro-carrier-sdk.test_mode', false);
        $this->url = $url ?? config('pro-carrier-sdk.base_url');
    }

    public function resolveBaseUrl(): string
    {
        $baseUrl = $this->url;
        ray($this->testMode);
        if ($this->testMode) {
            $baseUrl .= '?testMode=1';
        } else {
            $baseUrl .= '?testMode=0';
        }

        return $baseUrl;
    }

    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'text/json',
        ];
    }

    protected function defaultConfig(): array
    {
        return [
            'timeout' => config('pro-carrier-sdk.timeout', 30),
        ];
    }
}
