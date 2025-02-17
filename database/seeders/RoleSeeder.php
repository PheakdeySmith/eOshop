<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Create 'user' role if it doesn't already exist
        Role::firstOrCreate(['name' => 'user']);
    }
}
