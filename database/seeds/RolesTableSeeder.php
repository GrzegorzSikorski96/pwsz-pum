<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            Role::ADMINISTRATOR => 'administrator',
            Role::USER => 'user',
        ];

        foreach ($roles as $key => $value) {
            Role::firstOrCreate([
                'id' => $key,
                'name' => $value,
            ]);
        }
    }
}
