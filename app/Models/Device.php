<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Device extends Model
{
    protected $fillable = [
        'Device',
        'Name',
        'Lat',
        'Lon',
        'token',
    ];

    public function measurements(): HasMany
    {
        return $this->hasMany(Measurement::class, 'device_id');
    }
}