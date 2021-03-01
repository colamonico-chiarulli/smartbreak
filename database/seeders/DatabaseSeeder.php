<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Seeder::call(ClassesTableSeeder::class);
        Seeder::call(UsersTableSeeder::class);
        Seeder::call(ProductsTableSeeder::class);
        Seeder::call(OrdersTableSeeder::class);
    }
}
