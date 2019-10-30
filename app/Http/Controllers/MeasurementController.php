<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Services\DeviceService;
use App\Services\MeasurementService;
use Illuminate\Http\Request;

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

    public function get(Request $request, int $deviceId)
    {
        if ($request['start_date']) {
            $measurements = $this->measurementService->getFromDate($deviceId, $request['start_date']);
        } else {
            $measurements = $this->deviceService->measurements($deviceId);
        }

        return $this->apiResponse
            ->setData([
                'measurements' => $measurements
            ])
            ->setSuccessStatus()
            ->getResponse();
    }
}
