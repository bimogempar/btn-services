<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transactions')->insert([
            [
                'product_id' => 1, // Assuming this product exists
                'type' => 'stock_out',
                'quantity' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 1, // Assuming this product exists
                'type' => 'stock_out',
                'quantity' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2, // Assuming this product exists
                'type' => 'stock_out',
                'quantity' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2, // Assuming this product exists
                'type' => 'stock_out',
                'quantity' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
