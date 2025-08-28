<?php

namespace SmartDato\ProCarrier\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \SmartDato\ProCarrier\ProCarrier
 */
class ProCarrier extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \SmartDato\ProCarrier\ProCarrier::class;
    }
}
