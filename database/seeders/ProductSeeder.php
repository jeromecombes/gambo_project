<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            '',
            'Bokeh',
            'Koha',
            'Matomo',
            'NumaHOP',
            'Omeka S',
            'Omekalia',
            'Pikoloco',
            'Planno',
            'Urungi',
        ];

        foreach ($products as $elem) {
            $product = new Product();
            $product->name = $elem;
            $product->save();
        }
    }
}
