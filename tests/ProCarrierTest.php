<?php

use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use SmartDato\ProCarrier\Exceptions\ProCarrierException;
use SmartDato\ProCarrier\ProCarrier;
use SmartDato\ProCarrier\ProCarrierConnector;
use SmartDato\ProCarrier\Requests\TrackShipmentRequest;

afterEach(function () {
    MockClient::destroyGlobal();
});

it('uses the configured test mode when none is passed', function () {
    config()->set('pro-carrier-sdk.test_mode', true);

    $connector = (fn (): ProCarrierConnector => $this->connector)->call(new ProCarrier('test-api-key'));

    expect($connector->resolveBaseUrl())->toEndWith('?testMode=1');
});

it('lets an explicit test mode override the config', function () {
    config()->set('pro-carrier-sdk.test_mode', true);

    $connector = (fn (): ProCarrierConnector => $this->connector)->call(new ProCarrier('test-api-key', testMode: false));

    expect($connector->resolveBaseUrl())->toEndWith('?testMode=0');
});

it('does not treat an empty error as a failure', function () {
    MockClient::global([
        TrackShipmentRequest::class => MockResponse::make(['ErrorLevel' => 0, 'Error' => '']),
    ]);

    $response = (new ProCarrier('test-api-key'))->trackShipment('DG32733000013');

    expect($response->isSuccess())->toBeTrue();
});

it('throws when the api reports an error', function () {
    MockClient::global([
        TrackShipmentRequest::class => MockResponse::make(['ErrorLevel' => 10, 'Error' => 'Invalid API key']),
    ]);

    (new ProCarrier('test-api-key'))->trackShipment('DG32733000013');
})->throws(ProCarrierException::class, 'Invalid API key (10)');
