<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'title' => 'titre2',
            'user_id'=> 1,
            'picture'=>'https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=989&q=80',
            'product_description'=> 'description du produits numero 1',
            'product_price'=> 100,
            'product_type'=> 'Manga',
            'product_quantity'=> 3,
        ]);
        Product::create([
            'title' => 'titre3',
            'user_id'=> 1,
            'picture'=>'https://images.unsplash.com/photo-1491637639811-60e2756cc1c7?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=669&q=80',
            'product_description'=> 'description du produits numero 67',
            'product_price'=> 130,
            'product_type'=> 'JV',
            'product_quantity'=> 4,
        ]);
        Product::create([
            'title' => 'titre5',
            'user_id'=> 1,
            'picture'=>'https://images.unsplash.com/photo-1528740561666-dc2479dc08ab?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1868&q=80',
            'product_description'=> 'description du produits numero 5',
            'product_price'=> 150,
            'product_type'=> 'Manga',
            'product_quantity'=> 55,
        ]);
    }
}