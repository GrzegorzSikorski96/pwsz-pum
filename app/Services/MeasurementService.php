<?php

namespace App\Services;

use App\Models\Device;
use App\Models\Measurement;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class MeasurementService
{
    protected $deviceService;
    protected $linkService;

    public function __construct(DeviceService $deviceService, LinkService $linkService)
    {
        $this->deviceService = $deviceService;
        $this->linkService = $linkService;
    }

    public function fetchDeviceData(Device $device): Measurement
    {
        $device = $this->deviceService->device($device->id);

        $url = $this->linkService->generateUrl($device->Device, $device->token);

        $client = new Client();
        $response = $client->get($url);
        $data = json_decode($response->getBody()->getContents(), true);
        $measurement = new Measurement($data);
        $measurement->device_id = $device->id;
        $measurement->save();

        Storage::disk('public')->put("last/$device->Device.txt", $measurement);

        return $measurement;
    }

    public function fetchData(): void
    {
        $devices = Device::all();

        foreach ($devices as $device) {
            $this->fetchDeviceData($device);
        }
    }

    public function getFromDate(int $deviceId, string $date): Collection
    {
        $device = $this->deviceService->device($deviceId);
        $measurement = $device->measurements()->where('created_at', '>', Carbon::parse($date))->get();

        return $measurement;
    }
}
