<?php

namespace Database\Seeders;

use App\Models\SchoolClass;
use Illuminate\Database\Seeder;
use App\Models\Site;

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
        $sites=Site::all();
        $classes = SchoolClass::all();
        $faker = Faker\Factory::create('it_IT');

        DB::table('users')->insert([
            'email' => 'admin@smartbreak.it',
            'password' => Hash::make('AdminPassword'),
            'first_name' => 'Amministratore',
            'last_name' => 'SmartBreak',
            'role' => 'ADMIN',
            'class_id' => null
        ]);

        DB::table('users')->insert([
            'email' => 'manager1@smartbreak.it',
            'password' => Hash::make('ManagerPassword'),
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName(),
            'role' => 'MANAGER',
            'class_id' => null,
            'site_id' => 1
        ]);

        DB::table('users')->insert([
            'email' => 'manager2@smartbreak.it',
            'password' => Hash::make('ManagerPassword'),
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName(),
            'role' => 'MANAGER',
            'class_id' => $classes->random()->id,
            'site_id' => 2,
        ]);

        DB::table('users')->insert([
            'email' => 'student@smartbreak.it',
            'password' => Hash::make('StudentPassword'),
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName(),
            'role' => 'STUDENT',
            'class_id' => $classes->random()->id,
            'site_id' => 1,
        ]);

        // Generating Fake students

        foreach (range(1, 50) as $i) {
            DB::table('users')->insert([
                'email' => $faker->email(),
                'password' => Hash::make($faker->password()),
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'role' => 'STUDENT',
                'class_id' => $classes->random()->id,
                'site_id' => 1,
            ]);
        }

        $students= array(
            array("first_name"=>"Fabio","last_name"=>"Caccavone","email"=>"fabio.caccavone.inf@colamonicochiarulli.it","password"=>"kf7uYBel4NMz2Lq9","role"=>"STUDENT","class_id"=>21,"site_id"=>1),
            array("first_name"=>"Enzo","last_name"=>"Giorgio","email"=>"enzo.giorgio.inf@colamonicochiarulli.it","password"=>"vEf5tkaCdwm9soSn","role"=>"STUDENT","class_id"=>21,"site_id"=>1),
            array("first_name"=>"Giuseppe","last_name"=>"Giorgio","email"=>"giuseppe.giorgio.inf@colamonicochiarulli.it","password"=>"j82ZsFeTNAUa3SJx","role"=>"STUDENT","class_id"=>21,"site_id"=>1),
            array("first_name"=>"Alessia","last_name"=>"Pavone","email"=>"alessia.pavone.inf@colamonicochiarulli.it","password"=>"J86IpeAh24vPjgrM","role"=>"STUDENT","class_id"=>21,"site_id"=>1),
            array("first_name"=>"Antonella","last_name"=>"Perniola","email"=>"antonella.perniola.inf@colamonicochiarulli.it","password"=>"wK2aQbSuH0cGi3Tf","role"=>"STUDENT","class_id"=>21,"site_id"=>1),
            array("first_name"=>"Nicola","last_name"=>"Sergio","email"=>"nicola.sergio.inf@colamonicochiarulli.it","password"=>"XS69yRaZV5Px7WNt","role"=>"STUDENT","class_id"=>21,"site_id"=>1),
            array("first_name"=>"Chiara","last_name"=>"Vitolla","email"=>"chiara.vitolla.inf@colamonicochiarulli.it","password"=>"wGfoYrCNseI4UhEg","role"=>"STUDENT","class_id"=>21,"site_id"=>1),
            array("first_name"=>"Antonio","last_name"=>"Capotorti","email"=>"antonio.capotorti.inf@colamonicochiarulli.it","password"=>"yfwcEzt8J9nI5kgF","role"=>"STUDENT","class_id"=>22,"site_id"=>1),
            array("first_name"=>"Alessandro","last_name"=>"Cosmo","email"=>"alessandro.cosmo.inf@colamonicochiarulli.it","password"=>"qUaA4u1NDHQzdMYP","role"=>"STUDENT","class_id"=>22,"site_id"=>1),
            array("first_name"=>"Fabio","last_name"=>"Ladisa","email"=>"fabio.ladisa.inf@colamonicochiarulli.it","password"=>"k3EnsbPuUCY4vGc7","role"=>"STUDENT","class_id"=>22,"site_id"=>1),
            array("first_name"=>"Francesco","last_name"=>"Liantonio","email"=>"francesco.liantonio.inf@colamonicochiarulli.it","password"=>"YGDCWHB70kSzeItA","role"=>"STUDENT","class_id"=>22,"site_id"=>1),
            array("first_name"=>"Vito","last_name"=>"Serrone","email"=>"vito.serrone.inf@colamonicochiarulli.it","password"=>"cPkeaE1R8Xu2ALHm","role"=>"STUDENT","class_id"=>22,"site_id"=>1),
            array("first_name"=>"Filippo","last_name"=>"Gigante","email"=>"filippo.gigante.inf@colamonicochiarulli.it","password"=>"JhPOqx8cFDraH9y1","role"=>"STUDENT","class_id"=>33,"site_id"=>1),
            array("first_name"=>"Donato","last_name"=>"Scianatico","email"=>"donato.scianatico.inf@colamonicochiarulli.it","password"=>"qyeEmLwg0XtvC6OJ","role"=>"STUDENT","class_id"=>33,"site_id"=>1),
            array("first_name"=>"Marco","last_name"=>"Iacovelli","email"=>"marco.iacovelli.inf@colamonicochiarulli.it","password"=>"zwNGZUlIax3At8DY","role"=>"STUDENT","class_id"=>34,"site_id"=>1),
            array("first_name"=>"Michele","last_name"=>"Pontrelli","email"=>"michele.pontrelli.inf@colamonicochiarulli.it","password"=>"BH3TAUGcW0JhjVMC","role"=>"STUDENT","class_id"=>34,"site_id"=>1),
            array("first_name"=>"Marco","last_name"=>"Chimienti","email"=>"marco.chimienti.inf@colamonicochiarulli.it","password"=>"X8Qsnmy5gIoUNR3B","role"=>"STUDENT","class_id"=>47,"site_id"=>1),
            array("first_name"=>"Francesco Giovanni","last_name"=>"Cruciata","email"=>"francesco.cruciata.inf@colamonicochiarulli.it","password"=>"dBrcyU4zR8jNgf2p","role"=>"STUDENT","class_id"=>47,"site_id"=>1),
            array("first_name"=>"Gabriel","last_name"=>"Dellaccio","email"=>"gabriel.dellaccio.inf@colamonicochiarulli.it","password"=>"rgHUeukp6bxv0KXL","role"=>"STUDENT","class_id"=>47,"site_id"=>1),
            array("first_name"=>"Gianluigi","last_name"=>"Santorsola","email"=>"gianluigi.santorsola.inf@colamonicochiarulli.it","password"=>"Kw7pEB9OA4FXNajs","role"=>"STUDENT","class_id"=>47,"site_id"=>1),
            array("first_name"=>"Cosimo","last_name"=>"Simonetti","email"=>"cosimo.simonetti.inf@colamonicochiarulli.it","password"=>"tzTK2dPENuyoG31D","role"=>"STUDENT","class_id"=>47,"site_id"=>1),
            array("first_name"=>"Rino","last_name"=>"Andriano","email"=>"andriano@colamonicochiarulli.it","password"=>"w9SpUsd847amtDBe","role"=>"STUDENT","class_id"=>2,"site_id"=>1),
            array("first_name"=>"Irene","last_name"=>"Santamaria","email"=>"i.santamaria@colamonicochiarulli.it","password"=>"fYqGhJ6AljywZb0v","role"=>"STUDENT","class_id"=>2,"site_id"=>1),
            array("first_name"=>"Giovanni","last_name"=>"Ciriello","email"=>"g.ciriello.pon@colamonicochiarulli.it","password"=>"V8uPDWEvQi1dJqoC","role"=>"STUDENT","class_id"=>2,"site_id"=>1)
          );

        DB::table('users')->insert($students);
    }

}
