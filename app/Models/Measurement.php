<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Measurement extends Model
{
    protected $fillable = [
        'PM1',
        'IJP',
        'PM25',
        'PM10',
        'Temperature',
        'Humidity',
        'AveragePM1',
        'AveragePM25',
        'AveragePM10',
        'Humidity',
        'IJPDescription',
        'IJPString',
        'device_id',
    ];

    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class, 'deviceId');
    }
}