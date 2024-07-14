<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         User::create([
            'id'              => '9c5a0257-8a3c-4907-abd0-12d87436170f',
            'name'              => 'Administrator',
            'slug'              => 'administrator',
            'email'             => 'super@gmail.com',
            'username'          => 'Admin!',
            'phone_number'      => '08115986878',
            'masterstatus'      => '1',
            'email_verified_at' => now(),
            'password'          => bcrypt('secret12'),
            'remember_token'    => Str::random(30),
        ]);
    }
}
