<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Services\DeviceService;
use App\Services\MeasurementService;

class MeasurementController extends Controller
{
    protected $measurementService;
    protected $deviceService;

    public function __construct(ApiResponse $apiResponse, MeasurementService $measurementService, DeviceService $deviceService)
    {
        parent::__construct($apiResponse);
        $this->measurementService = $measurementService;
        $this->deviceService = $deviceService;
    }

    public function fetchDeviceMeasurement(int $deviceId)
    {
        $device = $this->deviceService->device($deviceId);
        $measurement = $this->measurementService->fetchDeviceData($device);

        return $this->apiResponse
            ->setData([
                'measurement' => $measurement
            ])
            ->setSuccessStatus()
            ->getResponse();
    }

    public function fetchAllDevicesMeasurements()
    {
        $this->measurementService->fetchData();

        return $this->apiResponse
            ->setSuccessStatus()
            ->getResponse();
    }

    public function get($device_id)
    {
        $measurements = $this->deviceService->measurements($device_id);

        return $this->apiResponse
            ->setData([
                'measurements' => $measurements
            ])
            ->setSuccessStatus()
            ->getResponse();
    }
}
