<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            ['category_id' => 1, 'name' => 'Smartphone', 'description' => 'Latest model', 'image' => 'smartphone.jpg', 'stock' => 100],
            ['category_id' => 1, 'name' => 'Laptop', 'description' => 'High-performance', 'image' => 'laptop.jpg', 'stock' => 50],
            ['category_id' => 2, 'name' => 'Fiction Novel', 'description' => 'Bestseller book', 'image' => 'fiction.jpg', 'stock' => 200],
            ['category_id' => 3, 'name' => 'T-shirt', 'description' => '100% cotton', 'image' => 'tshirt.jpg', 'stock' => 150],
        ]);
    }
}
