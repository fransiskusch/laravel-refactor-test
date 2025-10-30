<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::insert([
            ['name' => 'Keyboard', 'stock' => 10, 'price' => 150000],
            ['name' => 'Mouse', 'stock' => 25, 'price' => 80000],
            ['name' => 'Monitor', 'stock' => 5, 'price' => 1200000],
        ]);
    }
}
