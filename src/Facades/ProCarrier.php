<?php

namespace SmartDato\ProCarrier\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \SmartDato\ProCarrier\ProCarrier
 *
 * @method static \SmartDato\ProCarrier\Data\ApiResponseData parseResponse(\Saloon\Http\Response $response)
 * @method static \SmartDato\ProCarrier\Data\ApiResponseData createShipment(\SmartDato\ProCarrier\Data\ShipmentData $shipmentData)
 * @method static \SmartDato\ProCarrier\Data\ApiResponseData getShipmentLabel(string $trackingNumber = '', string $shipperReference = '', string $labelFormat = 'PDF', string $labelOption = 'System')
 * @method static \SmartDato\ProCarrier\Data\ApiResponseData getShipmentInvoice(string $trackingNumber = '', string $shipperReference = '', string $invoiceFormat = 'PDF')
 * @method static \SmartDato\ProCarrier\Data\ApiResponseData voidShipment(string $trackingNumber = '', string $shipperReference = '')
 * @method static \SmartDato\ProCarrier\Data\ApiResponseData trackShipment(string $trackingNumber = '', string $shipperReference = '')
 * @method static \SmartDato\ProCarrier\Data\ApiResponseData createParcelGroup(\SmartDato\ProCarrier\Data\GroupData $groupData)
 * @method static \SmartDato\ProCarrier\Data\ApiResponseData cancelParcelGroup(string $groupId)
 */
class ProCarrier extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \SmartDato\ProCarrier\ProCarrier::class;
    }
}
