<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'admin@demo.com',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'personal_number' => null,
            'region_id' => null,
            'station_id' => null,
            'designation' => null,
            'gender' => 'Male',
            'status' => 'active',
            'role' => 'admin',
            'date_of_birth' => '1990-01-01',
            'description' => 'System administrator',
        ]);

        $this->command->info('Admin user created successfully.');
    }
}