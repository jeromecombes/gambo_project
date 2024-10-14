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
        $product = new Product();
        $product->name = '';
        $product->save();

        $product = new Product();
        $product->name = 'Bokeh';
        $product->save();

        $product = new Product();
        $product->name = 'Koha';
        $product->save();

        $product = new Product();
        $product->name = 'Matomo';
        $product->save();

        $product = new Product();
        $product->name = 'NumaHOP';
        $product->save();

        $product = new Product();
        $product->name = 'Omeka S';
        $product->save();

        $product = new Product();
        $product->name = 'Omekalia';
        $product->save();

        $product = new Product();
        $product->name = 'Pikoloco';
        $product->save();

        $product = new Product();
        $product->name = 'Planno';
        $product->save();

        $product = new Product();
        $product->name = 'Urungi';
        $product->save();
    }
}
