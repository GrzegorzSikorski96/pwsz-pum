<?php

use App\Models\Measurement;
use Illuminate\Database\Seeder;

class MeasurementsTableSeeder extends Seeder
{
    public function run()

    {
        $begin = new DateTime(\Carbon\Carbon::now()->subDays(15));
        $end = new DateTime(\Carbon\Carbon::now());

        $interval = DateInterval::createFromDateString('1 hour');
        $period = new DatePeriod($begin, $interval, $end);

        foreach ($period as $dt) {
            Measurement::firstOrCreate([
                'PM1' => rand(3, 50),
                'PM25' => rand(3, 50),
                'PM10' => rand(3, 50),
                'AveragePM1' => rand(3, 50),
                'AveragePM25' => rand(3, 50),
                'AveragePM10' => rand(3, 50),
                'Temperature' => rand(3, 50),
                'Humidity' => rand(3, 50),
                'IJPDescription' => 'Jakość powietrza jest wciąż dobra. Zanieczyszczenia powietrza stanowią minimalne zagrożenie dla osób narażonych na ryzyko. Warunki bardzo dobre na aktywności na zewnątrz.',
                'IJPString' => 'Dobry',
                'device_id' => \App\Models\Device::first()->id,
                'created_at' => $dt
            ]);
        }
    }
}
