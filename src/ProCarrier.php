<?php

namespace SmartDato\ProCarrier;

use JsonException;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Request;
use SmartDato\ProCarrier\Data\ApiResponseData;
use SmartDato\ProCarrier\Data\GroupData;
use SmartDato\ProCarrier\Data\ShipmentData;
use SmartDato\ProCarrier\Exceptions\ProCarrierException;
use SmartDato\ProCarrier\Exceptions\ProCarrierFatalRequestException;
use SmartDato\ProCarrier\Exceptions\ProCarrierJsonRequestException;
use SmartDato\ProCarrier\Exceptions\ProCarrierRequestException;
use SmartDato\ProCarrier\Requests\CancelParcelGroupRequest;
use SmartDato\ProCarrier\Requests\CreateParcelGroupRequest;
use SmartDato\ProCarrier\Requests\GetShipmentInvoiceRequest;
use SmartDato\ProCarrier\Requests\GetShipmentLabelRequest;
use SmartDato\ProCarrier\Requests\OrderShipmentRequest;
use SmartDato\ProCarrier\Requests\TrackShipmentRequest;
use SmartDato\ProCarrier\Requests\VoidShipmentRequest;

class ProCarrier
{
    protected ProCarrierConnector $connector;

    protected string $apiKey;

    public function __construct(string $apiKey, bool $testMode = false)
    {
        $this->apiKey = $apiKey;
        $this->connector = new ProCarrierConnector($testMode);
    }

    /**
     * Create a new shipment
     * @param  ShipmentData  $shipmentData
     * @return ApiResponseData
     * @throws ProCarrierException
     * @throws ProCarrierFatalRequestException
     * @throws ProCarrierJsonRequestException
     * @throws ProCarrierRequestException
     */
    public function createShipment(ShipmentData $shipmentData): ApiResponseData
    {
        return $this->execute(
            new OrderShipmentRequest($this->apiKey, $shipmentData)
        );
    }

    /**
     * Get shipment label
     * @param  string  $trackingNumber
     * @param  string  $shipperReference
     * @param  string  $labelFormat
     * @param  string  $labelOption
     * @return ApiResponseData
     * @throws ProCarrierException
     * @throws ProCarrierFatalRequestException
     * @throws ProCarrierJsonRequestException
     * @throws ProCarrierRequestException
     */
    public function getShipmentLabel(
        string $trackingNumber = '',
        string $shipperReference = '',
        string $labelFormat = 'PDF',
        string $labelOption = 'System'
    ): ApiResponseData {
        return $this->execute(new GetShipmentLabelRequest(
            $this->apiKey,
            $trackingNumber,
            $shipperReference,
            $labelFormat,
            $labelOption
        ));
    }

    /**
     * Get shipment invoice
     * @param  string  $trackingNumber
     * @param  string  $shipperReference
     * @param  string  $labelFormat
     * @return ApiResponseData
     * @throws ProCarrierException
     * @throws ProCarrierFatalRequestException
     * @throws ProCarrierJsonRequestException
     * @throws ProCarrierRequestException
     */
    public function getShipmentInvoice(
        string $trackingNumber = '',
        string $shipperReference = '',
        string $labelFormat = 'PDF'
    ): ApiResponseData {
        return $this->execute(
            new GetShipmentInvoiceRequest(
                $this->apiKey,
                $trackingNumber,
                $shipperReference,
                $labelFormat
            )
        );
    }

    /**
     * Cancel/void a shipment
     * @param  string  $trackingNumber
     * @param  string  $shipperReference
     * @return ApiResponseData
     * @throws ProCarrierException
     * @throws ProCarrierFatalRequestException
     * @throws ProCarrierJsonRequestException
     * @throws ProCarrierRequestException
     */
    public function voidShipment(
        string $trackingNumber = '',
        string $shipperReference = ''
    ): ApiResponseData {
        return $this->execute(
            new VoidShipmentRequest(
                $this->apiKey,
                $trackingNumber,
                $shipperReference
            )
        );
    }

    /**
     * Track a shipment
     * @param  string  $trackingNumber
     * @param  string  $shipperReference
     * @return ApiResponseData
     * @throws ProCarrierException
     * @throws ProCarrierFatalRequestException
     * @throws ProCarrierJsonRequestException
     * @throws ProCarrierRequestException
     */
    public function trackShipment(
        string $trackingNumber = '',
        string $shipperReference = ''
    ): ApiResponseData {
        return $this->execute(
            new TrackShipmentRequest(
                $this->apiKey,
                $trackingNumber,
                $shipperReference
            )
        );
    }

    /**
     * Create a parcel group
     * @param  GroupData  $groupData
     * @return ApiResponseData
     * @throws ProCarrierException
     * @throws ProCarrierFatalRequestException
     * @throws ProCarrierJsonRequestException
     * @throws ProCarrierRequestException
     */
    public function createParcelGroup(GroupData $groupData): ApiResponseData
    {
        return $this->execute(
            new CreateParcelGroupRequest($this->apiKey, $groupData)
        );
    }

    /**
     * Cancel a parcel group
     * @param  string  $carrierId
     * @return ApiResponseData
     * @throws ProCarrierException
     * @throws ProCarrierFatalRequestException
     * @throws ProCarrierJsonRequestException
     * @throws ProCarrierRequestException
     */
    public function cancelParcelGroup(string $carrierId): ApiResponseData
    {
        return $this->execute(
            new CancelParcelGroupRequest($this->apiKey, $carrierId)
        );
    }


    /**
     * @throws ProCarrierFatalRequestException
     * @throws ProCarrierRequestException
     * @throws ProCarrierException
     * @throws ProCarrierJsonRequestException
     */
    protected function execute(Request $request): ApiResponseData
    {
        try {
            $response = $this->connector->send($request);
            $data = $response->json();
            if ($response->json('Error') !== null) {
                throw new ProCarrierException($response->json('Error').' ('.$response->json('ErrorLevel').')');
            }

            return ApiResponseData::fromArray($data);
        } catch (FatalRequestException $e) {
            throw new ProCarrierFatalRequestException($e->getMessage());
        } catch (RequestException $e) {
            throw new ProCarrierRequestException($e->getMessage());
        } catch (JsonException $e) {
            throw new ProCarrierJsonRequestException($e->getMessage());
        }
    }
}
