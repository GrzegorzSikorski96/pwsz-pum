<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\Device;
use App\Services\DeviceService;
use Illuminate\Http\JsonResponse;

class DeviceController extends Controller
{
    protected $deviceService;

    public function __construct(ApiResponse $apiResponse, DeviceService $deviceService)
    {
        parent::__construct($apiResponse);
        $this->deviceService = $deviceService;
    }

    public function device($deviceId): JsonResponse
    {
        $device = $this->deviceService->device($deviceId);

        return $this->apiResponse
            ->setData([
                'device' => $device,
            ])
            ->setSuccessStatus()
            ->getResponse();
    }

    public function devices(): JsonResponse
    {
        $devices = $this->deviceService->devices();

        return $this->apiResponse
            ->setData([
                'devices' => $devices,
            ])
            ->setSuccessStatus()
            ->getResponse();
    }

    public function create(Device $device): JsonResponse
    {
        $device = $this->deviceService->create($device->all());

        return $this->apiResponse
            ->setData([
                'device' => $device,
            ])
            ->setSuccessStatus()
            ->getResponse();
    }

    public function edit(Device $device, int $deviceId): JsonResponse
    {
        $edited = $this->deviceService->edit($device->all(), $deviceId);

        return $this->apiResponse
            ->setData([
                'device' => $edited,
            ])
            ->setSuccessStatus()
            ->getResponse();
    }

    public function remove($deviceId): JsonResponse
    {
        $this->deviceService->remove($deviceId);

        return $this->apiResponse
            ->setMessage('Removed')
            ->setSuccessStatus()
            ->getResponse();
    }
}
