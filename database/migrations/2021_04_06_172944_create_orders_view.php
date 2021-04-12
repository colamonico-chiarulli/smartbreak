<?php
/**
 * File:	/database/migrations/2021_04_06_172944_create_orders_view.php
 * @package smartbreak
 * @author  Rino Andriano <andriano@colamonicochiarulli.it>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: Wednesday, April 7th 2021, 10:12:15 am
 * -----
 * Last Modified: 	April 12th 2021 8:10:43 pm
 * Modified By: 	Rino Andriano <andriano@colamonicochiarulli.it>
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
 * "(C) IISS Colamonico-Chiarulli-https://colamonicochiarulli.it - 2021".
 * 
 * ------------------------------------------------------------------------------
 */

?>
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateOrdersView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement($this->createView1());
        DB::statement($this->createView2());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }

    /**
     * createView.
     *
     * @access	private
     * @return	void
     */
    private function createView1(): string
    {
        return <<< END
        CREATE OR REPLACE VIEW orders_amount_by_id AS
        SELECT order_id, SUM(quantity*price) as total, site_id, class_id, DATE(orders.created_at) as date_day 
              from order_product 
              INNER JOIN orders ON order_id=orders.id 
              INNER JOIN users ON user_id=users.id 
              GROUP BY order_id;
        END;
    }

    /**
     * createView.
     *
     * @access	private
     * @return	void
     */
    private function createView2(): string
    {
        return <<< END
        CREATE OR REPLACE VIEW orders_amount_by_site_day AS 
        SELECT site_id, date_day, SUM(total) as total from orders_amount_by_id 
               GROUP BY site_id, date_day
               ORDER BY site_id, date_day; 
        END;
    }

}
