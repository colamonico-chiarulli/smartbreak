<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;

use Faker;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('it_IT');
        $students = User::where('role', 'STUDENT')->get();
        $products = Product::all();

        //Per ogni studente
        foreach ($students as $student) {
            // Crea da 1 a 10 Ordini
            $nOrders = mt_rand(1,10);
            for($i=0; $i < $nOrders; $i++) { 
                $dateTime=$faker->dateTimeBetween('-10 day', 'now','Europe/Rome');
                $order = $student->orders()->create([
                    'created_at' => $dateTime,
                    'updated_at' => $dateTime,
                ]);

                //Ciascun ordine ha da 1 a 5 prodotti casuali della sede dell'utente
                $faker = Faker\Factory::create('it_IT');
                $nProducts = mt_rand(1,5);
                for($p=0; $p <= $nProducts; $p++) { 
                    if ($student->site_id == 1){
                        $product = $products->where('id', $faker->unique()->numberBetween(1, 75))->first();
                    } else {
                        $product = $products->where('id', $faker->unique()->numberBetween(76, 150))->first();
                    }    

                    $order->products()->attach($product->id, [
                        'quantity' => $faker->numberBetween(1, 5),
                        'price' => $product->price
                    ]);
                }
            }
        }
    }
}
