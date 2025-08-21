<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run(): void
    {
        Role::updateOrCreate(['name' => 'admin'], [
            'description' => 'Administrator role with full access'
        ]);

        Role::updateOrCreate(['name' => 'user'], [
            'description' => 'Default user role'
        ]);
    }
}
