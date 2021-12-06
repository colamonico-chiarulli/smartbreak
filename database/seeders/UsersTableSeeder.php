<?php
/**
 * File:	/database/seeders/UsersTableSeeder.php
 * @package smartbreak
 * @author  Giovanni Ciriello <giovanni.ciriello.5@gmail.com>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	December 15th, 2020 11:05pm
 * -----
 * Last Modified: 	May 3rd 2021 11:22:46 am
 * Modified By: 	Rino Andriano <andriano@colamonicochiarulli.edu.it>
 * -----
 * @license	https://www.gnu.org/licenses/agpl-3.0.html AGPL 3.0
 * ------------------------------------------------------------------------------
 * SmartBreak is a School Bar food booking web application
 * developed during the PON course "The AppFactory" 2020-2021 with teachers
 * & students of "Informatica e Telecomunicazioni"
 * at IISS "C. Colamonico - N. Chiarulli" Acquaviva delle Fonti (BA)-Italy
 * Expert dr. Giovanni Ciriello <giovanni.ciriello.5@gmail.com>
 * ----------------------------------------------------------------------------
 * SmartBreak is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by
 * the Free Software Foundation
 *
 * SmartBreak is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * You should have received a copy of the GNU Affero General Public License along
 * with this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * The interactive user interfaces in original and modified versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the SmartBreak
 * logo and IISS "Colamonico-Chiarulli" copyright notice. If the display of the logo
 * is not reasonably feasible for technical reasons, the Appropriate Legal Notices
 * must display the words
 * "(C) IISS Colamonico-Chiarulli-https://colamonicochiarulli.edu.it - 2021".
 *
 * ------------------------------------------------------------------------------
 */

?>
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
        $sites = Site::all();
        $classes = SchoolClass::all();
        $faker = Faker\Factory::create('it_IT');

        DB::table('users')->insert([
            'email' => 'admin@smartbreak.it',
            'password' => Hash::make('AdminPassword'),
            'first_name' => 'Amministratore',
            'last_name' => 'SmartBreak',
            'role' => 'ADMIN',
            'class_id' => null,
            'site_id' => null,
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
            'class_id' => null,
            'site_id' => 2,
        ]);

        DB::table('users')->insert([
            'email' => 'student@smartbreak.it',
            'password' => Hash::make('StudentPassword'),
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName(),
            'role' => 'STUDENT',
            'class_id' => 12, //1INF-A
            'site_id' => 1,
        ]);

        // Generating (5..10) Fake students for each classroom
        foreach ($classes as $class) {
            foreach (range(5, 10) as $i) {
                DB::table('users')->insert([
                    'email' => $faker->unique()->email(),
                    'password' => Hash::make($faker->password()),
                    'first_name' => $faker->firstName(),
                    'last_name' => $faker->lastName(),
                    'role' => 'STUDENT',
                    'class_id' => $class->id,
                    'site_id' => $class->site_id,
                ]);
            }
        }

        $students = array(
            array("first_name" => "Fabio", "last_name" => "Caccavone", "email" => "fabio.caccavone.inf@colamonicochiarulli.edu.it", "password" => "kf7uYBel4NMz2Lq9", "role" => "STUDENT", "class_id" => 21, "site_id" => 1),
            array("first_name" => "Enzo", "last_name" => "Giorgio", "email" => "enzo.giorgio.inf@colamonicochiarulli.edu.it", "password" => "vEf5tkaCdwm9soSn", "role" => "STUDENT", "class_id" => 21, "site_id" => 1),
            array("first_name" => "Giuseppe", "last_name" => "Giorgio", "email" => "giuseppe.giorgio.inf@colamonicochiarulli.edu.it", "password" => "j82ZsFeTNAUa3SJx", "role" => "STUDENT", "class_id" => 21, "site_id" => 1),
            array("first_name" => "Alessia", "last_name" => "Pavone", "email" => "alessia.pavone.inf@colamonicochiarulli.edu.it", "password" => "J86IpeAh24vPjgrM", "role" => "STUDENT", "class_id" => 21, "site_id" => 1),
            array("first_name" => "Antonella", "last_name" => "Perniola", "email" => "antonella.perniola.inf@colamonicochiarulli.edu.it", "password" => "wK2aQbSuH0cGi3Tf", "role" => "STUDENT", "class_id" => 21, "site_id" => 1),
            array("first_name" => "Nicola", "last_name" => "Sergio", "email" => "nicola.sergio.inf@colamonicochiarulli.edu.it", "password" => "XS69yRaZV5Px7WNt", "role" => "STUDENT", "class_id" => 21, "site_id" => 1),
            array("first_name" => "Chiara", "last_name" => "Vitolla", "email" => "chiara.vitolla.inf@colamonicochiarulli.edu.it", "password" => "wGfoYrCNseI4UhEg", "role" => "STUDENT", "class_id" => 21, "site_id" => 1),
            array("first_name" => "Antonio", "last_name" => "Capotorti", "email" => "antonio.capotorti.inf@colamonicochiarulli.edu.it", "password" => "yfwcEzt8J9nI5kgF", "role" => "STUDENT", "class_id" => 22, "site_id" => 1),
            array("first_name" => "Alessandro", "last_name" => "Cosmo", "email" => "alessandro.cosmo.inf@colamonicochiarulli.edu.it", "password" => "qUaA4u1NDHQzdMYP", "role" => "STUDENT", "class_id" => 22, "site_id" => 1),
            array("first_name" => "Fabio", "last_name" => "Ladisa", "email" => "fabio.ladisa.inf@colamonicochiarulli.edu.it", "password" => "k3EnsbPuUCY4vGc7", "role" => "STUDENT", "class_id" => 22, "site_id" => 1),
            array("first_name" => "Francesco", "last_name" => "Liantonio", "email" => "francesco.liantonio.inf@colamonicochiarulli.edu.it", "password" => "YGDCWHB70kSzeItA", "role" => "STUDENT", "class_id" => 22, "site_id" => 1),
            array("first_name" => "Vito", "last_name" => "Serrone", "email" => "vito.serrone.inf@colamonicochiarulli.edu.it", "password" => "cPkeaE1R8Xu2ALHm", "role" => "STUDENT", "class_id" => 22, "site_id" => 1),
            array("first_name" => "Filippo", "last_name" => "Gigante", "email" => "filippo.gigante.inf@colamonicochiarulli.edu.it", "password" => "JhPOqx8cFDraH9y1", "role" => "STUDENT", "class_id" => 33, "site_id" => 1),
            array("first_name" => "Donato", "last_name" => "Scianatico", "email" => "donato.scianatico.inf@colamonicochiarulli.edu.it", "password" => "qyeEmLwg0XtvC6OJ", "role" => "STUDENT", "class_id" => 33, "site_id" => 1),
            array("first_name" => "Marco", "last_name" => "Iacovelli", "email" => "marco.iacovelli.inf@colamonicochiarulli.edu.it", "password" => "zwNGZUlIax3At8DY", "role" => "STUDENT", "class_id" => 34, "site_id" => 1),
            array("first_name" => "Michele", "last_name" => "Pontrelli", "email" => "michele.pontrelli.inf@colamonicochiarulli.edu.it", "password" => "BH3TAUGcW0JhjVMC", "role" => "STUDENT", "class_id" => 34, "site_id" => 1),
            array("first_name" => "Marco", "last_name" => "Chimienti", "email" => "marco.chimienti.inf@colamonicochiarulli.edu.it", "password" => "X8Qsnmy5gIoUNR3B", "role" => "STUDENT", "class_id" => 47, "site_id" => 1),
            array("first_name" => "Francesco Giovanni", "last_name" => "Cruciata", "email" => "francesco.cruciata.inf@colamonicochiarulli.edu.it", "password" => "dBrcyU4zR8jNgf2p", "role" => "STUDENT", "class_id" => 47, "site_id" => 1),
            array("first_name" => "Gabriel", "last_name" => "Dellaccio", "email" => "gabriel.dellaccio.inf@colamonicochiarulli.edu.it", "password" => "rgHUeukp6bxv0KXL", "role" => "STUDENT", "class_id" => 47, "site_id" => 1),
            array("first_name" => "Gianluigi", "last_name" => "Santorsola", "email" => "gianluigi.santorsola.inf@colamonicochiarulli.edu.it", "password" => "Kw7pEB9OA4FXNajs", "role" => "STUDENT", "class_id" => 47, "site_id" => 1),
            array("first_name" => "Cosimo", "last_name" => "Simonetti", "email" => "cosimo.simonetti.inf@colamonicochiarulli.edu.it", "password" => "tzTK2dPENuyoG31D", "role" => "STUDENT", "class_id" => 47, "site_id" => 1),
            array("first_name" => "Rino", "last_name" => "Andriano", "email" => "andriano@colamonicochiarulli.edu.it", "password" => "w9SpUsd847amtDBe", "role" => "STUDENT", "class_id" => 2, "site_id" => 1),
            array("first_name" => "Irene", "last_name" => "Santamaria", "email" => "i.santamaria@colamonicochiarulli.edu.it", "password" => "fYqGhJ6AljywZb0v", "role" => "STUDENT", "class_id" => 2, "site_id" => 1),
            array("first_name" => "Giovanni", "last_name" => "Ciriello", "email" => "g.ciriello.pon@colamonicochiarulli.edu.it", "password" => "V8uPDWEvQi1dJqoC", "role" => "STUDENT", "class_id" => 2, "site_id" => 1)
        );

        DB::table('users')->insert($students);
    }
}
