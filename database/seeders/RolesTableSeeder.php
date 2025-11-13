<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {[
        ['id' => 1, 'name' => 'user', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'product-manager', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'commercial', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'admin', 'created_at' => now(), 'updated_at' => now()]];
    }
}
