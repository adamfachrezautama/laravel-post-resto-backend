<?php

namespace Database\Seeders;

use App\Models\Discount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Discount::create([
            'name' => 'new member',
            'description' => 'Member baru',
            'type' => 'percentage',
            'value' => '5',
            'status' => 'active',
            'expired_date' => '2025-01-31',
        ]);
    }
}
