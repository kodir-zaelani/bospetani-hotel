<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'id'   => '9c5a0257-8e78-4a12-bfae-af78c9b9e842',
            'name' => 'superadmin',
        ]);
        Role::create([
            'id'   => '9c5a0257-8fd3-461f-af57-39be70677088',
            'name' => 'admin',
        ]);
        Role::create([
            'id'   => '9c5a0257-90c5-4857-8c57-07a779c5c351',
            'name' => 'employee',
        ]);
        Role::create([
            'id'   => '9c5a0257-9215-49f4-9b70-cc59f319eb2c',
            'name' => 'author',
        ]);
        Role::create([
            'id'   => '9c5a0257-9303-4762-a62e-6f3c9937cd19',
            'name' => 'editor',
        ]);
        Role::create([
            'id'   => '9c5a0257-93e1-4d0b-ac89-aff5eda80ecc',
            'name' => 'subscribe',
        ]);
        Role::create([
            'id'   => '9c5a0257-94bf-45eb-a25a-7cb5a5b5f0f6',
            'name' => 'general',
        ]);
        Role::create([
            'id'   => '9c5a0257-95a2-453e-9ced-d562870e93ba',
            'name' => 'customer',
        ]);
        // Role::create(['name' => 'superadmin']);
        // Role::create(['name' => 'admin']);
        // Role::create(['name' => 'employee']);
        // Role::create(['name' => 'author']);
        // Role::create(['name' => 'editor']);
        // Role::create(['name' => 'subscribe']);
        // Role::create(['name' => 'general']);
        // Role::create(['name' => 'customer']);
    }
}
