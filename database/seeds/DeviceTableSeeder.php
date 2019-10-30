<?php

use App\Models\Device;
use Illuminate\Database\Seeder;

class DeviceTableSeeder extends Seeder
{
    public function run(): void
    {
        Device::firstOrCreate([
            'Device' => '60019458BA10',
            'Name' => 'PWSZimWitelonawLegnicy',
            'Lat' => 51.2051,
            'Lon' => 16.1503,
            'token' => '1570445090',
        ]);
    }
}
