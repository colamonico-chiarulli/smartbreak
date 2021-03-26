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

        foreach ($students as $student) {
            foreach (range(1, 10) as $i) {
                $order = $student->orders()->create([
                    'created_at' => $faker->dateTimeBetween('-2 day', 'now')
                ]);

                $faker = Faker\Factory::create('it_IT');
                foreach (range(0, $faker->randomDigitNotNull()) as $p) {
                    $product = $products->where('id', $faker->unique()->numberBetween(1, 75))->first();

                    $order->products()->attach($product->id, [
                        'quantity' => $faker->numberBetween(1, 5),
                        'price' => $product->price
                    ]);
                }
            }
        }
    }
}
