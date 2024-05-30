<?php
/**
 * File:	/database/seeders/OrdersTableSeeder.php
 * @package smartbreak
 * @author  Giovanni Ciriello <giovanni.ciriello.5@gmail.com>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	February 27th, 2021 12:06pm
 * -----
 * Last Modified: 	December 13th 2023 08:40:00 pm
 * Modified By: 	Rino Andriano <andriano@colamonicochiarulli.edu.it>
 * -----
 * HISTORY:
 * Date      	By           	Comments
 * ----------	-------------	----------------------------------
 * 2023-12-13   R. Andriano     Get products from each user site
 * 2021-04-30	R. Andriano	    Update
 * 2021-02-27	G. Ciriello	    First release 
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
        $year = date("Y");
        $previousyear = $year -1;

        //Per ogni studente
        foreach ($students as $student) {
            // Crea da 5 a 50 Ordini dallo scorso settembre a ieri
            $nOrders = mt_rand(5, 50);
            for ($i=0; $i < $nOrders; $i++) {
                $dateTime=$faker->dateTimeBetween($previousyear.'-09-01', 'yesterday', 'Europe/Rome');
                //$dateTime=$faker->dateTimeBetween('-2 month', 'now', 'Europe/Rome');
                $order = $student->orders()->create([
                    'created_at' => $dateTime,
                    'updated_at' => $dateTime,
                ]);

                //Ciascun ordine ha da 1 a 3 prodotti casuali della sede dell'utente
                $products = Product::Where('site_id',$student->site_id)->get();
                $faker = Faker\Factory::create('it_IT');
                $nProducts = mt_rand(1, 3);
                for ($p=0; $p <= $nProducts; $p++) {
                    $product = $faker->unique()->randomElement($products);

                    //quantità da 1 a 2
                    $order->products()->attach($product->id, [
                        'quantity' => $faker->numberBetween(1, 2),
                        //'quantity' => 1,
                        'price' => $product->price
                    ]);
                }
            }
        }
    }
}
