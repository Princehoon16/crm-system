<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,        // Pehle users create karega
            SampleDataSeeder::class,  // Phir orders & tickets add karega
        ]);
    }
}