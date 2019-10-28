<?php

namespace App\Services;

use App\Models\Device;
use Illuminate\Database\Eloquent\Collection;

class DeviceService
{
    public function device(int $id): Device
    {
        return Device::findOrFail($id);
    }

    public function devices(): Collection
    {
        return Device::all();
    }

    public function create(array $request): Device
    {
        $device = new Device($request);
        $device->save();

        return $device;
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
}
