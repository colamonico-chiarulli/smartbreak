<?php
/**
 * File:	/app/Http/Controllers/AnalyticsController.php
 * @package smartbreak
 * @author  Giovanni Ciriello <giovanni.ciriello.5@gmail.com>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	March 30th, 2021 10:54am
 * -----
 * Last Modified: 	April 16th 2021 7:34:26 pm
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

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\Order;
use App\Models\ViewOrderByCategoryDay;
use Illuminate\Database\Eloquent\Builder;
use App\Models\ViewOrderByDay;

class AnalyticsController extends Controller
{
    public $sites;
    public $user_site;
    
    public function getAnalyticsPage()
    {
        //recupera la sede dell'utente (Manager) o tutte le sedi (Admin)
        $this->user_site= auth()->user()->site_id;
        $this->sites = Site::where('id', 'like', '%'.$this->user_site)->get();
        
        $chart["barChart"] = $this->getBarChartDataset();
        $chart["pieChart"] = $this->getPieChartDataset();
        
        // Crea una stringa con i nomi della/e sede/i
        $user_site=implode(", ", $this->sites->pluck('name')->toArray());
        
        return view('pages.analytics.index', compact('chart','user_site'));
    }

    /**
     * getBarChartDataset.
     * 
     * Prepara il dataset delle vendite per sede, giorno
     * @access	private
     * @return	mixed
     */
    private function getBarChartDataset(){

        $date_from = now()->subDays(7)->toDateString();
        $date_to = now()->addDay()->toDateString();


        $datasets = [];

        foreach ($this->sites as $site) {
            $orders = ViewOrderByDay::where('site_id', $site->id)
                ->whereBetween('date_day', [$date_from, $date_to])
                ->get();

            $labels = $orders->pluck('date_day')->transform(function ($date) {
                return formatDate($date);
            });

            $datasets[] = [
                'label' => $site->name,
                'data' => $orders->pluck('total'),
                'backgroundColor' => '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6),
            ];
        } 
            
        $chart = [
            "datasets" => $datasets,
            "labels" => $labels,
        ];
        
        return $chart;
    }

    /**
     * getPieChartDataset.
     * 
     * Prepara il dataset delle vendite per sede, categoria, giorno
     * @access	private
     * @return	mixed
     */
    private function getPieChartDataset(){
        $date_from = now()->subDays(7)->toDateString();
        $date_to = now()->addDay()->toDateString();

        $datasets = [];

        foreach ($this->sites as $site) {
            $orders = ViewOrderByCategoryDay::where('site_id', $site->id)
                ->whereBetween('date_day', [$date_from, $date_to])
                ->groupBy('category_id')
                ->selectRaw('category_id, name, sum(total) as total')
                ->get();
            
            $labels = $orders->pluck('name');
            $data=$orders->pluck('total','name')->values();
            foreach($labels as $item){
                $colors[]= '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);   
            }
            
            
            $datasets[] = [
                'label' => "Colamonico",
                'data' => $data,
                'backgroundColor' => $colors,
            ];
        }
        
        $chart = [
            "datasets" => $datasets,
            "labels" => $labels,
        ];
        
        return $chart;
    }

    
}
