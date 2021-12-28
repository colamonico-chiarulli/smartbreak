<?php
/**
 * File:	/database/seeders/ClassesTableSeeder.php
 * @package smartbreak
 * @author  Giovanni Ciriello <giovanni.ciriello.5@gmail.com>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	December 15th, 2020 11:05pm
 * -----
 * Last Modified: 	May 3rd 2021 11:20:42 am
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

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        DB::table('sites')->insert([
            ['id' => 1, 'name' => 'Colamonico'],
            ['id' => 2, 'name' => 'Chiarulli']
        ]);

        $classes = array(
            array("year"=>1,"section"=>"A","course"=>"AFM","site_id"=>1),
            array("year"=>2,"section"=>"A","course"=>"AFM","site_id"=>1),
            array("year"=>2,"section"=>"B","course"=>"AFM","site_id"=>1),
            array("year"=>3,"section"=>"A","course"=>"AFM","site_id"=>1),
            array("year"=>3,"section"=>"B","course"=>"AFM","site_id"=>1),
            array("year"=>3,"section"=>"S","course"=>"AFM","site_id"=>1),
            array("year"=>4,"section"=>"A","course"=>"AFM","site_id"=>1),
            array("year"=>4,"section"=>"S","course"=>"AFM","site_id"=>1),
            array("year"=>5,"section"=>"A","course"=>"AFM","site_id"=>1),
            array("year"=>5,"section"=>"B","course"=>"AFM","site_id"=>1),
            array("year"=>5,"section"=>"S","course"=>"AFM","site_id"=>1),
            array("year"=>1,"section"=>"A","course"=>"INF","site_id"=>1),
            array("year"=>1,"section"=>"B","course"=>"INF","site_id"=>1),
            array("year"=>1,"section"=>"C","course"=>"INF","site_id"=>1),
            array("year"=>2,"section"=>"A","course"=>"INF","site_id"=>1),
            array("year"=>2,"section"=>"B","course"=>"INF","site_id"=>1),
            array("year"=>3,"section"=>"A","course"=>"INF","site_id"=>1),
            array("year"=>3,"section"=>"B","course"=>"INF","site_id"=>1),
            array("year"=>4,"section"=>"A","course"=>"INF","site_id"=>1),
            array("year"=>4,"section"=>"B","course"=>"INF","site_id"=>1),
            array("year"=>5,"section"=>"A","course"=>"INF","site_id"=>1),
            array("year"=>4,"section"=>"A","course"=>"RIM","site_id"=>1),
            array("year"=>1,"section"=>"A","course"=>"TUR","site_id"=>1),
            array("year"=>2,"section"=>"A","course"=>"TUR","site_id"=>1),
            array("year"=>3,"section"=>"A","course"=>"TUR","site_id"=>1),
            array("year"=>4,"section"=>"A","course"=>"TUR","site_id"=>1),
            array("year"=>5,"section"=>"A","course"=>"TUR","site_id"=>1),
            array("year"=>4,"section"=>"A","course"=>"AIS","site_id"=>2),
            array("year"=>5,"section"=>"A","course"=>"AIS","site_id"=>2),
            array("year"=>1,"section"=>"A","course"=>"MAT","site_id"=>2),
            array("year"=>2,"section"=>"A","course"=>"MAT","site_id"=>2),
            array("year"=>2,"section"=>"B","course"=>"MAT","site_id"=>2),
            array("year"=>3,"section"=>"A","course"=>"MAT","site_id"=>2),
            array("year"=>3,"section"=>"B","course"=>"MAT","site_id"=>2),
            array("year"=>3,"section"=>"S","course"=>"MAT","site_id"=>2),
            array("year"=>4,"section"=>"S","course"=>"MAT","site_id"=>2),
            array("year"=>5,"section"=>"S","course"=>"MAT","site_id"=>2),
            array("year"=>1,"section"=>"A","course"=>"MiI","site_id"=>2),
            array("year"=>2,"section"=>"A","course"=>"MiI","site_id"=>2),
            array("year"=>3,"section"=>"A","course"=>"MiI","site_id"=>2),
            array("year"=>4,"section"=>"A","course"=>"MMT","site_id"=>2),
            array("year"=>5,"section"=>"A","course"=>"MMT","site_id"=>2),
            array("year"=>3,"section"=>"S","course"=>"PIA","site_id"=>2),
            array("year"=>4,"section"=>"S","course"=>"PIA","site_id"=>2),
            array("year"=>4,"section"=>"A","course"=>"PTS","site_id"=>2),
            array("year"=>4,"section"=>"B","course"=>"PTS","site_id"=>2),
            array("year"=>5,"section"=>"A","course"=>"PTS","site_id"=>2),
            array("year"=>3,"section"=>"A","course"=>"TBS","site_id"=>2),
            array("year"=>4,"section"=>"A","course"=>"TBS","site_id"=>2),
            array("year"=>5,"section"=>"A","course"=>"TBS","site_id"=>2),
            array("year"=>1,"section"=>"A","course"=>"TCM","site_id"=>2),
            array("year"=>2,"section"=>"A","course"=>"TCM","site_id"=>2)
          );


        DB::table('classes')->insert($classes);
    }
}
