<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB;
use Hash;

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
            'email' => 'giovanni.ciriello.5@gmail.com',
            'password' => Hash::make('password'),
            'first_name' => 'Giovanni',
            'last_name' => 'Ciriello'
        ]);
    }
}
