<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Products;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Products::create([
            'user_id' => 1,
            'name' => 'First Product',
            'image' => 'product.png',
            'descreption' => 'welcome to my first seeder in laravel',
            'price' => 150,
            'status' => 'Active'
        ]);
    }
}
