<?php

namespace App\Services;

use App\Models\Device;
use App\Models\Measurement;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Collection;

class DeviceService
{
    protected $linkService;

    public function __construct(LinkService $linkService)
    {
        $this->linkService = $linkService;
    }

    public function device(int $id): Device
    {
        return Device::findOrFail($id);
    }

    public function devices(): Collection
    {
        return Device::all();
    }

    public function edit(array $data, int $deviceId): Device
    {
        $device = $this->device($deviceId);
        $device->fill($data);
        $device->save();

        return $device;
    }

    public function remove(int $deviceId): void
    {
        $agency = $this->device($deviceId);
        $agency->delete();
    }

    public function measurements(int $deviceId): Collection
    {
        return $this->device($deviceId)->measurements;
    }

    public function fetch(string $deviceId, string $token): array
    {
        $url = $this->linkService->generateUrl($deviceId, $token);

        $client = new Client();
        $response = $client->get($url);
        $data = json_decode($response->getBody()->getContents(), true);
        $device = new Device($data);
        $device->token = $token;
        $device->save();

        $measurement = new Measurement($data);
        $measurement->device_id = $device->id;
        $measurement->save();

        return [
            'device' => $device,
            'measurement' => $measurement,
        ];
    }

    public function lastMeasurements(): Collection
    {
        $devices = Device::with('measurements')->get()->map(function ($query) {
            $query->setRelation('measurements', $query->measurements->take(1));
            return $query;
        });

        return $devices;
    }

    public function lastMeasurementsFile(string $deviceId)
    {
        return public_path("storage/last/$deviceId.txt");
    }
}
