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
            'name' => 'Beheerder',
            'email' => 'dev+admin@soapbox.nl',
            'password' => Hash::make('dev+admin@soapbox.nl'),
        ]);

        User::factory()->create([
            'name' => 'Jos',
            'email' => 'dev+jos@soapbox.nl',
            'password' => Hash::make('dev+jos@soapbox.nl'),
        ]);
    }
}
