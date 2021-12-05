<?php

/**
 * File:	/app/Http/Controllers/AnalyticsController.php
 * @package smartbreak
 * @author  Giovanni Ciriello <giovanni.ciriello.5@gmail.com>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	March 30th, 2021 10:54am
 * -----
 * Last Modified: 	May 3rd 2021 4:20:23 pm
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

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\ViewOrderByCategoryDay;
use App\Models\ViewOrderByDay;
use App\Models\ViewOrderById;
use App\Models\ViewOrderByUser;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    const COLORS = [
        "#32936f", "#264653", "#93032e", "#e83f6f", "#ffbf00", "#2274a5", "#510d0a", "#717ec3", "#296eb4", "#020122", "#08415c",
        "#8eedf7", "#068d9d", "#043565", "#f4d35e", "#95d7ae", "#f4f4f9", "#94849b", "#eb6534", "#99d17b", "#d4f4dd", "#eb6534"
    ];
    //Random Color
    // $colors = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
    const MONTH = ['Gen', 'Feb', 'Mar', 'Apr', 'Mag', 'Giu', 'Lug', 'Ago', 'Set', 'Ott', 'Nov', 'Dic'];

    /**
     * getAnalyticsPage.
     * 
     * Chiamata al caricamento della pagina
     * Prepara i dati solo dei tre box info
     * i grafici saranno richiamati  via Ajax onLoad e al cambio parametri
     * 
     * @access	public
     * @return	mixed
     */
    public function getAnalyticsPage()
    {
        // Crea una stringa con i nomi della/e sede/i o con il nome utente
        if (auth()->user()->role == "STUDENT") {
            $title = auth()->user()->first_name;
        } else {
            $title = auth()->user()->mySiteName();
        }
        
        //Al primo caricamento visualizza solo i box statistici
        $role = auth()->user()->role;
        switch ($role) {
            case 'ADMIN':
                $range = $this->getRange();
                $stats = $this->getAdminStats($range);
                break;
            case 'MANAGER':
                $range = $this->getRange();
                $user_site = auth()->user()->site_id;
                $stats = $this->getManagerStats($user_site, $range);
                break;
            case 'STUDENT':
                $range = $this->getRange('month');
                $stats = $this->getStudentStats($range);
                break;
        }
        
        return view('pages.analytics.index', compact('title','stats','range'));
    }

    /**
     * getChartsDataset.
     *
     * Restituisce i dati dei grafici
     * 
     * @access	public
     * @param	request	$request	
     * @return	mixed
     */
    public function getChartsDataset(Request $request)
    {
        $period = $request->input('period');
        $move = $request->input('move');
        $prevRange = $request->input('range');

        $range = $this->getRange($period,$move,$prevRange);
        $result['range'] = $range;
        $period = $request->input('period');

        $user_site = auth()->user()->site_id;
        $role = auth()->user()->role;

        switch ($role) {
            case 'ADMIN':
                $result['barChart'] = $this->getAdminBarChart($range, $period);
                $result['pieChart'] = $this->getAdminPieChartDataset($range);
                //se la pagina è stata già caricata aggiorna anche le statistiche
                if($prevRange) $result['stats'] = $this->getAdminStats($range); 
                break;
            case 'MANAGER':
                $result['barChart'] = $this->getManagerBarChartDataset($user_site, $range, $period);
                $result['pieChart'] = $this->getManagerPieChartDataset($user_site, $range);
                if($prevRange) $result['stats'] = $this->getManagerStats($user_site, $range);
                break;
            case 'STUDENT':
                $result['barChart'] = $this->getStudentBarChartDataset($range, $period);
                $result['pieChart'] = $this->getStudentPieChartDataset($range);
                if($prevRange) $result['stats'] = $this->getStudentStats($range);
                break;
        }

        return $result;
    }


    /**
     * getRange.
     * Prepara il range dei grafici (data-inizio e data-fine)
     * in base alle scelte dell'utente (settimana-mese-anno)
     * indietro nel tempo <- move -> avanti nel tempo
     *
     * @access	private
     * @param	mixed	$period "week", "month", "year"   	
     * @param	mixed	$move   "left", "right" (time shift)     	
     * @param	mixed	$prevRange (previous range)	
     * @return	mixed
     */
    private function getRange($period = "week", $move = null, $prevRange = null)
    {
        $start = ($move == null) ? $start = today() : new Carbon($prevRange['from']);

        $range = [];
        switch ($period) {
            case 'year':
                if ($move == 'left') $start->subYear();
                if ($move == 'right') $start->addYear();
                $range['from'] = $start->startOfYear()->toDateString();
                $range['to'] = $start->endOfYear()->toDateString();
                $range['label'] = 'Anno ' . $start->year;
                break;

            case 'month':
                if ($move == 'left')  $start->subMonth();
                if ($move == 'right') $start->addMonth();
                $range['from'] = $start->startOfMonth()->toDateString();
                $range['to'] = $start->endOfMonth()->toDateString();
                $range['label'] = $start->translatedFormat('F Y');
                break;

            case 'week':
                if ($move == 'right') $start->addDays(12);
                $range['from'] = $start->subDays(6)->toDateString();
                $range['to'] = $start->addDays(6)->toDateString();
                $range['label'] = 'Dal ' . formatShortDate($range['from']) . ' al ' . formatShortDate($range['to']);
                break;
        }

        return $range;
    }


    /**
     * getManagerBarChartDataset.
     * Prepara il dataset del ricavato vendite per sede, periodo (settimana, mese, anno)
     * per un grafico a barre (Manager)
     *
     * @param	mixed	$user_site	
     * @param	mixed	$range    	
     * @param	mixed	$period   	
     * @return	array
     */
    private function getManagerBarChartDataset($user_site, $range, $period)
    {
        $labels = [];

        switch ($period) {
            case 'year':
                $orders = ViewOrderByDay::where('site_id', $user_site)
                    ->whereBetween('date_day', [$range['from'], $range['to']])
                    ->selectRaw('site_id, MONTH(date_day) as month, sum(total) as total')
                    ->groupBy('month')
                    ->get();;
                foreach ($orders->pluck('month') as $month) {
                    $labels[] = self::MONTH[--$month];
                }
                break;

            case 'month':
            case 'week':
                $orders = ViewOrderByDay::where('site_id', $user_site)
                    ->whereBetween('date_day', [$range['from'], $range['to']])
                    ->get();
                $labels = $orders->pluck('date_day')->transform(function ($date) {
                    return formatShortDate($date);
                });
                break;
        }

        $datasets = [
            'label' => $range['label'],
            'data' => $orders->pluck('total'),
            'backgroundColor' => self::COLORS[$user_site],
        ];

        return [
            "labels" => $labels,
            "datasets" => [$datasets],
            "title"=> "Ricavi",
        ];
    }


    /**
     * getManagerPieChartDataset.
     * Prepara il dataset delle vendite per sede, categoria, periodo
     * per un grafico a torta o ciambella
     *
     * @access	public
     * @param	mixed	$user_site	
     * @param	mixed	$range    	
     * @return	array
     */
    private function getManagerPieChartDataset($user_site, $range)
    {
        $orders = ViewOrderByCategoryDay::where('site_id', $user_site)
            ->whereBetween('date_day', [$range['from'], $range['to']])
            ->groupBy('category_id')
            ->selectRaw('category_id, name, sum(total) as total')
            ->orderBy('name')
            ->get();

        $labels = $orders->pluck('name');
        $data = $orders->pluck('total', 'name')->values();
        $colors = array_slice(self::COLORS, 0, count($labels));

        $datasets[] = [
            'data' => $data,
            'backgroundColor' => $colors,
        ];

        return [
            "title"=> "Ricavi per Categoria",
            "labels" => $labels,
            "datasets" => $datasets,
        ];
    }

    /**
     * getManagerStats
     * Prepara le statistiche per il MANAGER
     *
     * @access	private
     * @param	mixed	$user_site	
     * @param	mixed	$range    	
     * @return	array
     */
    private function getManagerStats($user_site, $range)
    {
        $income = ViewOrderById::where('site_id', $user_site)
            ->whereBetween('date_day', [$range['from'], $range['to']])
            ->sum('total');
        $num_orders = ViewOrderById::where('site_id', $user_site)
            ->whereBetween('date_day', [$range['from'], $range['to']])
            ->count();
        $num_products = ViewOrderById::where('site_id', $user_site)
            ->whereBetween('date_day', [$range['from'], $range['to']])
            ->sum('num_items');
        if ($income) {
            return [
                'box1' => formatPrice($income),
                'box2' => number_format($num_orders, 0, ',', '.'),
                'box3' => number_format($num_products, 0, ',', '.'),
            ];
        }
    }

    /**
     * getAdminBarChart
     * Prepara le statistiche per l'admin
     *
     * @access	private
     * @param	mixed	$range	
     * @return	array
     */
    private function getAdminBarChart($range, $period)
    {
        $sites = Site::all();
        $labels=[];
        
        foreach ($sites as $site) {

            switch ($period) {
                case 'year':
                    $orders = ViewOrderById::where('site_id', $site->id)
                        ->whereBetween('date_day', [$range['from'], $range['to']])
                        ->selectRaw('MONTH(date_day) as month, count(order_id) as orders')
                        ->groupBy('month');
                    foreach ($orders->pluck('month') as $month) {
                        $labels[] = self::MONTH[--$month];
                    }
                    break;

                case 'month':
                case 'week':
                    $orders = ViewOrderById::where('site_id', $site->id)
                        ->whereBetween('date_day', [$range['from'], $range['to']])
                        ->selectRaw('date_day, count(order_id) as orders')
                        ->groupBy('date_day');

                    $labels = $orders->pluck('date_day')->transform(function ($date) {
                        return formatShortDate($date);
                    });
                    break;
            }


            $datasets[] = [
                'label' => $site->name,
                'data' => $orders->pluck('orders'),
                'backgroundColor' => self::COLORS[--$site->id],
            ];
        }


        return [
            "title"=> "Ordini per sede",
            "labels" => $labels,
            "datasets" => $datasets,
        ];
    }

    /**
     * getAdminPieChartDataset.
     * Prepara il dataset degli ordini per sede, categoria, periodo
     * per un grafico a torta o ciambella
     *
     * @access	public
     * @param	mixed	$user_site	
     * @param	mixed	$range    	
     * @return	array
     */
    private function getAdminPieChartDataset($range)
    {
        $orders = DB::table('orders_amount_by_id')
            ->join('sites', 'site_id', '=', 'sites.id')
            ->whereBetween('date_day', [$range['from'], $range['to']])
            ->groupBy('site_id')
            ->selectRaw('site_id, sites.name as site_name ,count(order_id) as orders')
            ->orderBy('site_id')
            ->get();

        $labels = $orders->pluck('site_name');
        $data = $orders->pluck('orders', 'site_name')->values();
        $colors = array_slice(self::COLORS, 0, count($labels));

        $datasets[] = [
            'data' => $data,
            'backgroundColor' => $colors,
        ];

        return [
            "title"=> "Ordini per sede",
            "labels" => $labels,
            "datasets" => $datasets,
        ];
    }

    /**
     * getAdminStats
     * Prepara le statistiche per l'admin
     *
     * @access	private
     * @param	mixed	$user_site	
     * @param	mixed	$range    	
     * @return	array
     */
    private function getAdminStats($range)
    {
        $num_orders = ViewOrderById::whereBetween('date_day', [$range['from'], $range['to']])
            ->count('order_id');
        $num_products = ViewOrderById::whereBetween('date_day', [$range['from'], $range['to']])
            ->sum('num_items');
        $num_users = ViewOrderById::whereBetween('date_day', [$range['from'], $range['to']])
            ->distinct('user_id')
            ->count('user_id');
        if ($num_orders) {
            return [
                'box1' => number_format($num_users,  0,',', '.'),
                'box2' => number_format($num_orders, 0, ',', '.'),
                'box3' => number_format($num_products, 0, ',', '.'),
            ];
        }
    }

    /**
     * getStudentBarChartDataset.
     * Prepara il dataset delle spese per utente, periodo (settimana, mese, anno)
     * per un grafico a barre (Student)
     *
     * @param	mixed	$user_site	
     * @param	mixed	$range    	
     * @param	mixed	$period   	
     * @return	array
     */
    private function getStudentBarChartDataset($range, $period)
    {
        $user_id = auth()->user()->id;
        $labels = [];

        switch ($period) {
            case 'year':
                $orders = ViewOrderById::where('user_id', $user_id)
                    ->whereBetween('date_day', [$range['from'], $range['to']])
                    ->selectRaw('User_id, MONTH(date_day) as month, sum(total) as total')
                    ->groupBy('month')
                    ->get();;
                foreach ($orders->pluck('month') as $month) {
                    $labels[] = self::MONTH[--$month];
                }
                break;

            case 'month':
            case 'week':
                $orders = ViewOrderById::where('user_id', $user_id)
                    ->whereBetween('date_day', [$range['from'], $range['to']])
                    ->selectRaw('User_id, date_day, sum(total) as total')
                    ->groupBy('date_day')
                    ->orderBy('date_day')
                    ->get();
                $labels = $orders->pluck('date_day')->transform(function ($date) {
                    return formatShortDate($date);
                });
                break;
        }

        $datasets = [
            'label' => $range['label'],
            'data' => $orders->pluck('total'),
            'backgroundColor' => self::COLORS[0],
        ];

        return [
            "title"=> "Le tue spese", 
            "labels" => $labels,
            "datasets" => [$datasets],
        ];
    }


    /**
     * getStudentPieChartDataset.
     * Prepara il dataset delle spese per categoria, periodo
     * per un grafico a torta o ciambella (Student)
     *
     * @access	public
     * @param	mixed	$user_site	
     * @param	mixed	$range    	
     * @return	array
     */
    private function getStudentPieChartDataset($range)
    {
        $user_id = auth()->user()->id;

        $orders = ViewOrderByUser::where('user_id', $user_id)
            ->join('categories', 'category_id', '=', 'categories.id')
            ->whereBetween('date_day', [$range['from'], $range['to']])
            ->groupBy('category_id')
            ->selectRaw('name, sum(total) as total')
            ->orderBy('name')
            ->get();

        $labels = $orders->pluck('name');
        $data = $orders->pluck('total', 'name')->values();
        $colors = array_slice(self::COLORS, 0, count($labels));

        $datasets[] = [
            'data' => $data,
            'backgroundColor' => $colors,
        ];

        return [
            "title"=> "Spese per Categoria", 
            "labels" => $labels,
            "datasets" => $datasets,
        ];
    }

    /**
     * getStudentStats
     * Prepara le statistiche per il MANAGER
     *
     * @access	private
     * @param	mixed	$user_site	
     * @param	mixed	$range    	
     * @return	array
     */
    private function getStudentStats($range)
    {
        $user_id = auth()->user()->id;

        $expenses = ViewOrderById::where('user_id', $user_id)
            ->whereBetween('date_day', [$range['from'], $range['to']])
            ->sum('total');
        $num_orders = ViewOrderById::where('user_id', $user_id)
            ->whereBetween('date_day', [$range['from'], $range['to']])
            ->count();
        $num_products = ViewOrderById::where('user_id', $user_id)
            ->whereBetween('date_day', [$range['from'], $range['to']])
            ->sum('num_items');
        if ($expenses) {
            return [
                'box1' => formatPrice($expenses),
                'box2' => number_format($num_orders, 0, ',', '.'),
                'box3' => number_format($num_products, 0, ',', '.'),
            ];
        }
    }
}
