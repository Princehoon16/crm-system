<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sale;
use App\Models\User;
use Carbon\Carbon;

class SalesSeeder extends Seeder
{
    public function run(): void
    {
        $salesTeam = User::whereIn('role', ['sales_manager', 'sales_representative'])->get();
        
        if ($salesTeam->isEmpty()) {
            // Agar sales team nahi hai toh kuch sales users create karein
            $salesManager = User::create([
                'name' => 'Sales Manager',
                'email' => 'salesmanager@example.com',
                'password' => bcrypt('password'),
                'role' => 'sales_manager'
            ]);
            
            $salesRep = User::create([
                'name' => 'Sales Representative', 
                'email' => 'salesrep@example.com',
                'password' => bcrypt('password'),
                'role' => 'sales_representative'
            ]);
            
            $salesTeam = collect([$salesManager, $salesRep]);
        }

        // Sample sales data create karein
        foreach($salesTeam as $salesPerson) {
            for ($i = 1; $i <= 10; $i++) {
                Sale::create([
                    'customer_name' => 'Customer ' . $i . ' - ' . $salesPerson->name,
                    'customer_email' => 'customer' . $i . '@example.com',
                    'customer_phone' => '98765432' . $i,
                    'product_service' => 'Product ' . rand(1, 5),
                    'amount' => rand(5000, 50000),
                    'sale_date' => Carbon::now()->subDays(rand(1, 60)),
                    'status' => 'completed',
                    'sales_person_id' => $salesPerson->id,
                    'notes' => 'Sample sale for testing'
                ]);
            }
        }
    }
}