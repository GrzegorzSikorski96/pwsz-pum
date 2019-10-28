<?php

namespace App\Services;

use App\Models\Device;
use App\Models\Measurement;
use GuzzleHttp\Client;

class MeasurementService
{
    protected $deviceService;

    public function __construct(DeviceService $deviceService)
    {
        $this->deviceService = $deviceService;
    }

    public function fetchDeviceData(Device $device): Measurement
    {
        $device = $this->deviceService->device($device->id);

        $url = $this->generateUrl($device);

        $client = new Client();
        $response = $client->get($url);
        $data = json_decode($response->getBody()->getContents(), true);
        $measurement = new Measurement($data);
        $measurement->device_id = $device->id;
        $measurement->save();

        return $measurement;
    }

    public function fetchData()
    {
        $devices = Device::all();

        foreach ($devices as $device) {
            $this->fetchDeviceData($device);
        }
    }

    public function generateUrl(Device $device): string
    {
        return 'http://api.looko2.com/?method=GetLOOKO&id=' . $device->Device . '&token=' . $device->token;
    }
}
