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
            'personal_number' => 'ADMIN001',
            'region_id' => 1, // Punjab
            'station_id' => 1, // Jhelum
            'designation' => 'Senior Observer',
            'gender' => 'Male',
            'status' => 'active',
            'role' => 'admin', 
            'is_admin' => true,
            'date_of_birth' => '1990-01-01',
            'description' => 'System administrator',
        ]);

        $this->command->info('Admin user created successfully.');
    }
}