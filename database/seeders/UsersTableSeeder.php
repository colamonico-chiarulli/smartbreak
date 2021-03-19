<?php

namespace Database\Seeders;

use App\Models\SchoolClass;
use Illuminate\Database\Seeder;

use DB;
use Hash;
use Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'manager@appfactory.it',
            'password' => Hash::make('password'),
            'first_name' => 'Giovanni',
            'last_name' => 'Ciriello',
            'role' => 'MANAGER',
            'class_id' => null,
            'site_id' => 1
        ]);

        DB::table('users')->insert([
            'email' => 'admin@appfactory.it',
            'password' => Hash::make('password'),
            'first_name' => 'Giovanni',
            'last_name' => 'Ciriello',
            'role' => 'ADMIN',
            'class_id' => null,
            'site_id' => null
        ]);



        $classes = SchoolClass::all();

        // Generating students

        foreach (range(1, 50) as $i) {
            DB::table('users')->insert([
                'email' => $faker->email(),
                'password' => Hash::make('password'),
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'role' => 'STUDENT',
                'class_id' => $classes->random()->id
            ]);
        }

        DB::table('users')->insert([
            'email' => 'g.ciriello.pon@colamonicochiarulli.it',
            'password' => Hash::make('password'),
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName(),
            'role' => 'STUDENT',
            'class_id' => $classes->random()->id
        ]);
    }
}
