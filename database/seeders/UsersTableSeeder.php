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
            'class_id' => 12, //2INF-A
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

    }
}
