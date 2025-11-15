<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin Account
        User::create([
            'name' => 'CRM Admin',
            'email' => 'admin@crm.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'role' => 'admin',                    // ✅ ADD THIS
            'wallet_balance' => 10000,           // ✅ ADD THIS
            'reward_points' => 500,              // ✅ ADD THIS
        ]);

        // Sales Manager
        User::create([
            'name' => 'Sales Manager',
            'email' => 'sales@crm.com', 
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'role' => 'sales_manager',           // ✅ ADD THIS
            'wallet_balance' => 7500,            // ✅ ADD THIS
            'reward_points' => 300,              // ✅ ADD THIS
        ]);

        // Regular User
        User::create([
            'name' => 'Test User',
            'email' => 'user@crm.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'role' => 'user',                    // ✅ ADD THIS
            'wallet_balance' => 2500,            // ✅ ADD THIS
            'reward_points' => 150,              // ✅ ADD THIS
        ]);

        $this->command->info('Users seeded successfully!');
    }
}