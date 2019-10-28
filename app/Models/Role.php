<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    protected $table = 'roles';
    public $timestamps = false;

    const ADMINISTRATOR = 1;
    const USER = 2;

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users', 'role_id');
    }
}
