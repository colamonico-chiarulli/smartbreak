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
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur impedit explicabo molestias dolor ipsa earum recusandae placeat eaque. Dolorum eos fugiat nesciunt dolor. Eligendi possimus ullam enim, non excepturi voluptatibus.',
                'allergens' => 'Latte, Uova',
                'price' => 10.5,
                'num_items' => 50,
                'default_daily_stock' => 100,
                'category_id' => 1,
			 	'photo_path' => 'pomodori.png',
			],
			[
                'name' => 'Cipolle',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur impedit explicabo molestias dolor ipsa earum recusandae placeat eaque. Dolorum eos fugiat nesciunt dolor. Eligendi possimus ullam enim, non excepturi voluptatibus.',
                'allergens' => 'Latte, Uova',
                'price' => 10.5,
                'num_items' => 50,
                'default_daily_stock' => 100,
                'category_id' => 3,
			 	'photo_path' => 'cipolle.png',
			],
			[
                'name' => 'Angry onion',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur impedit explicabo molestias dolor ipsa earum recusandae placeat eaque. Dolorum eos fugiat nesciunt dolor. Eligendi possimus ullam enim, non excepturi voluptatibus.',
                'allergens' => 'Latte, Uova',
                'price' => 10.5,
                'num_items' => 50,
                'default_daily_stock' => 100,
                'category_id' => 3,
			 	'photo_path' => 'angryonions.png',
			],
			[
                'name' => 'Insalata',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur impedit explicabo molestias dolor ipsa earum recusandae placeat eaque. Dolorum eos fugiat nesciunt dolor. Eligendi possimus ullam enim, non excepturi voluptatibus.',
                'allergens' => 'Latte, Uova',
                'price' => 10.5,
                'num_items' => 50,
                'default_daily_stock' => 100,
                'category_id' => 2,
			 	'photo_path' => 'insalata.png',
			],
			[
                'name' => 'Formaggio',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur impedit explicabo molestias dolor ipsa earum recusandae placeat eaque. Dolorum eos fugiat nesciunt dolor. Eligendi possimus ullam enim, non excepturi voluptatibus.',
                'allergens' => 'Latte, Uova',
                'price' => 10.5,
                'num_items' => 50,
                'default_daily_stock' => 100,
                'category_id' => 1,
			 	'photo_path' => 'formaggio.png',
			],
			[
                'name' => 'Salsa king',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur impedit explicabo molestias dolor ipsa earum recusandae placeat eaque. Dolorum eos fugiat nesciunt dolor. Eligendi possimus ullam enim, non excepturi voluptatibus.',
                'allergens' => 'Latte, Uova',
                'price' => 10.5,
                'num_items' => 50,
                'default_daily_stock' => 100,
                'category_id' => 2,
			 	'photo_path' => 'salsa.png',
			],
			[
                'name' => 'Bacon',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur impedit explicabo molestias dolor ipsa earum recusandae placeat eaque. Dolorum eos fugiat nesciunt dolor. Eligendi possimus ullam enim, non excepturi voluptatibus.',
                'allergens' => 'Latte, Uova',
                'price' => 10.5,
                'num_items' => 50,
                'default_daily_stock' => 100,
                'category_id' => 3,
			 	'photo_path' => 'bacon.png',
			],
			[
                'name' => 'Cipolle pastellate',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur impedit explicabo molestias dolor ipsa earum recusandae placeat eaque. Dolorum eos fugiat nesciunt dolor. Eligendi possimus ullam enim, non excepturi voluptatibus.',
                'allergens' => 'Latte, Uova',
                'price' => 10.5,
                'num_items' => 50,
                'default_daily_stock' => 100,
                'category_id' => 4,
			 	'photo_path' => 'cipollepastellate.png',
			],
			[
                'name' => 'Prosciutto',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur impedit explicabo molestias dolor ipsa earum recusandae placeat eaque. Dolorum eos fugiat nesciunt dolor. Eligendi possimus ullam enim, non excepturi voluptatibus.',
                'allergens' => 'Latte, Uova',
                'price' => 10.5,
                'num_items' => 50,
                'default_daily_stock' => 100,
                'category_id' => 1,
			 	'photo_path' => 'prosciutto.png',
			],
			[
                'name' => 'Acqua',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur impedit explicabo molestias dolor ipsa earum recusandae placeat eaque. Dolorum eos fugiat nesciunt dolor. Eligendi possimus ullam enim, non excepturi voluptatibus.',
                'allergens' => 'Latte, Uova',
                'price' => 10.5,
                'num_items' => 50,
                'default_daily_stock' => 100,
                'category_id' => 2,
			 	'photo_path' => 'acqua.png',
			],
			[
                'name' => 'Pepperjack',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur impedit explicabo molestias dolor ipsa earum recusandae placeat eaque. Dolorum eos fugiat nesciunt dolor. Eligendi possimus ullam enim, non excepturi voluptatibus.',
                'allergens' => 'Latte, Uova',
                'price' => 10.5,
                'num_items' => 50,
                'default_daily_stock' => 100,
                'category_id' => 1,
			 	'photo_path' => 'pepperjack.png',
			],
			[
                'name' => 'Cipolle fritte',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur impedit explicabo molestias dolor ipsa earum recusandae placeat eaque. Dolorum eos fugiat nesciunt dolor. Eligendi possimus ullam enim, non excepturi voluptatibus.',
                'allergens' => 'Latte, Uova',
                'price' => 10.5,
                'num_items' => 50,
                'default_daily_stock' => 100,
                'category_id' => 4,
			 	'photo_path' => 'cipollefritte.png',
			],
			[
                'name' => 'Insalatina',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur impedit explicabo molestias dolor ipsa earum recusandae placeat eaque. Dolorum eos fugiat nesciunt dolor. Eligendi possimus ullam enim, non excepturi voluptatibus.',
                'allergens' => 'Latte, Uova',
                'price' => 10.5,
                'num_items' => 50,
                'default_daily_stock' => 100,
                'category_id' => 2,
			 	'photo_path' => 'insalatina.png',
			]
		]);
    }
}
