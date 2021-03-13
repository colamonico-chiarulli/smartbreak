<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'Panini'],
            ['name' => 'Snack'],
            ['name' => 'Pucce'],
            ['name' => 'Dolci'],
        ]);

        DB::table('products')->insert([
            [
                'name' => 'Pomodori',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
                'allergens' => 'Latte, Uova',
                'price' => 10.5,
                'num_items' => 50,
                'default_daily_stock' => 100,
                'category_id' => 1,
                'photo_path' => 'pomodori.png',
                'site_id' => 1
            ],
            [
                'name' => 'Cipolle',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
                'allergens' => 'Latte, Uova',
                'price' => 10.5,
                'num_items' => 50,
                'default_daily_stock' => 100,
                'category_id' => 3,
                'photo_path' => 'cipolle.png',
                'site_id' => 1
            ],
            [
                'name' => 'Angry onion',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
                'allergens' => 'Latte, Uova',
                'price' => 10.5,
                'num_items' => 50,
                'default_daily_stock' => 100,
                'category_id' => 3,
                'photo_path' => 'angryonions.png',
                'site_id' => 1
            ],
            [
                'name' => 'Insalata',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
                'allergens' => 'Latte, Uova',
                'price' => 10.5,
                'num_items' => 50,
                'default_daily_stock' => 100,
                'category_id' => 2,
                'photo_path' => 'insalata.png',
                'site_id' => 1
            ],
            [
                'name' => 'Formaggio',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
                'allergens' => 'Latte, Uova',
                'price' => 10.5,
                'num_items' => 50,
                'default_daily_stock' => 100,
                'category_id' => 1,
                'photo_path' => 'formaggio.png',
                'site_id' => 1
            ],
            [
                'name' => 'Salsa king',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
                'allergens' => 'Latte, Uova',
                'price' => 10.5,
                'num_items' => 50,
                'default_daily_stock' => 100,
                'category_id' => 2,
                'photo_path' => 'salsa.png',
                'site_id' => 1
            ],
            [
                'name' => 'Bacon',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
                'allergens' => 'Latte, Uova',
                'price' => 10.5,
                'num_items' => 50,
                'default_daily_stock' => 100,
                'category_id' => 3,
                'photo_path' => 'bacon.png',
                'site_id' => 1
            ],
            [
                'name' => 'Cipolle pastellate',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
                'allergens' => 'Latte, Uova',
                'price' => 10.5,
                'num_items' => 50,
                'default_daily_stock' => 100,
                'category_id' => 4,
                'photo_path' => 'cipollepastellate.png',
                'site_id' => 1
            ],
            [
                'name' => 'Prosciutto',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
                'allergens' => 'Latte, Uova',
                'price' => 10.5,
                'num_items' => 50,
                'default_daily_stock' => 100,
                'category_id' => 1,
                'photo_path' => 'prosciutto.png',
                'site_id' => 1
            ],
            [
                'name' => 'Acqua',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
                'allergens' => 'Latte, Uova',
                'price' => 10.5,
                'num_items' => 50,
                'default_daily_stock' => 100,
                'category_id' => 2,
                'photo_path' => 'acqua.png',
                'site_id' => 1
            ],
            [
                'name' => 'Pepperjack',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
                'allergens' => 'Latte, Uova',
                'price' => 10.5,
                'num_items' => 50,
                'default_daily_stock' => 100,
                'category_id' => 1,
                'photo_path' => 'pepperjack.png',
                'site_id' => 1
            ],
            [
                'name' => 'Cipolle fritte',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
                'allergens' => 'Latte, Uova',
                'price' => 10.5,
                'num_items' => 50,
                'default_daily_stock' => 100,
                'category_id' => 4,
                'photo_path' => 'cipollefritte.png',
                'site_id' => 1
            ],
            [
                'name' => 'Insalatina',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
                'allergens' => 'Latte, Uova',
                'price' => 10.5,
                'num_items' => 50,
                'default_daily_stock' => 100,
                'category_id' => 2,
                'photo_path' => 'insalatina.png',
                'site_id' => 1
            ]
        ]);
    }
}
