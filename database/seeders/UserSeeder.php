<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'dev+admin@soapbox.nl',
            'password' => Hash::make('dev+admin@soapbox.nl'),
        ]);

        User::factory()->create([
            'name' => 'Kaj',
            'email' => 'dev+kaj@soapbox.nl',
            'password' => Hash::make('dev+kaj@soapbox.nl'),
        ]);

        User::factory()->create([
            'name' => 'Mads',
            'email' => 'dev+mads@soapbox.nl',
            'password' => Hash::make('dev+mads@soapbox.nl'),
        ]);
    }
}
