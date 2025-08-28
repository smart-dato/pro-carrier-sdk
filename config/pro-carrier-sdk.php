<?php

// config for SmartDato/ProCarrier
return [
    'api_key' => env('PRO_CARRIER_API_KEY', ''),
    'base_url' => env('PRO_CARRIER_BASE_URL', 'https://dgapi.app/API/'),

    'test_mode' => (bool) env('PRO_CARRIER_TEST_MODE', false),
    'timeout' => (int) env('PRO_CARRIER_TIMEOUT', 30),
];
