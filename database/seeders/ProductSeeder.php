<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
        $products = [
            [
                'category_id' => 1,
                'name' => 'Gitar Akustik',
                'purchase_price' => 1000000,
                'sale_price' => 1500000,
                'stock' => 30,
                'image' => 'gitar-akustik.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 1,
                'name' => 'Piano Elektrik',
                'purchase_price' => 3500000,
                'sale_price' => 5000000,
                'stock' => 15,
                'image' => 'piano-elektrik.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 1,
                'name' => 'Drum Elektrik',
                'purchase_price' => 2000000,
                'sale_price' => 3000000,
                'stock' => 10,
                'image' => 'drum-elektrik.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 1,
                'name' => 'Saksofon',
                'purchase_price' => 2500000,
                'sale_price' => 4000000,
                'stock' => 20,
                'image' => 'saksofon.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 2,
                'name' => 'Bola Sepak',
                'purchase_price' => 300000,
                'sale_price' => 450000,
                'stock' => 100,
                'image' => 'bola-sepak.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 2,
                'name' => 'Raket Tenis',
                'purchase_price' => 700000,
                'sale_price' => 1000000,
                'stock' => 50,
                'image' => 'raket-tenis.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 2,
                'name' => 'Sepatu Basket',
                'purchase_price' => 400000,
                'sale_price' => 600000,
                'stock' => 70,
                'image' => 'sepatu-basket.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 2,
                'name' => 'Bola Voli',
                'purchase_price' => 150000,
                'sale_price' => 220000,
                'stock' => 150,
                'image' => 'bola-voli.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 2,
                'name' => 'Tas Golf',
                'purchase_price' => 600000,
                'sale_price' => 900000,
                'stock' => 30,
                'image' => 'tas-golf.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 2,
                'name' => 'Set Golf',
                'purchase_price' => 5000000,
                'sale_price' => 7000000,
                'stock' => 5,
                'image' => 'set-golf.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('products')->insert($products);
    }
}
