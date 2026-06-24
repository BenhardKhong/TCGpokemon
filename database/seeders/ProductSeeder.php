<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([

            'name' =>
            'Pokemon 151 Booster Box',

            'description' =>
            'Official Pokemon Scarlet & Violet Booster Box',

            'price' =>
            850000,

            'stock' =>
            10,

            'image' =>
            'booster1.png'

        ]);

        Product::create([

            'name' =>
            'Crown Zenith Elite Trainer Box',

            'description' =>
            'Special Elite Trainer Box Pokemon',

            'price' =>
            1200000,

            'stock' =>
            5,

            'image' =>
            'booster2.png'

        ]);

        Product::create([

            'name' =>
            'Pokemon GO Booster Pack',

            'description' =>
            'Pokemon GO Official Booster Pack',

            'price' =>
            75000,

            'stock' =>
            25,

            'image' =>
            'booster3.png'

        ]);
    }
}