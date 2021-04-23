<?php

/**
 * File:	/app/Http/Controllers/AnalyticsController.php
 * @package smartbreak
 * @author  Giovanni Ciriello <giovanni.ciriello.5@gmail.com>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	March 30th, 2021 10:54am
 * -----
 * Last Modified: 	April 23rd 2021 12:11:41 pm
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
     * i grafici saranno richiamati  via Ajax onLoad e al cambio parametri
     * 
     * @access	public
     * @return	mixed
     */
    public function getAnalyticsPage()
    {
        // Crea una stringa con i nomi della/e sede/i o con il nome utente
        if (auth()->user()->role == "STUDENT") {
            $user_site = auth()->user()->first_name;
        } else {
            $user_site = auth()->user()->mySiteName();
        }
        return view('pages.analytics.index', compact('user_site'));
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
        $range = $this->getRange($request);
        $result['range'] = $range;
        $period = $request->input('period');

        $user_site = auth()->user()->site_id;
        $role = auth()->user()->role;

        switch ($role) {
            case 'ADMIN':
                $result['barChart'] = $this->getAdminBarChart($range, $period);
                $result['pieChart'] = $this->getAdminPieChartDataset($range);
                $result['stats'] = $this->getAdminStats($range);
                break;
            case 'MANAGER':
                $result['barChart'] = $this->getManagerBarChartDataset($user_site, $range, $period);
                $result['pieChart'] = $this->getManagerPieChartDataset($user_site, $range);
                $result['stats'] = $this->getManagerStats($user_site, $range);
                break;
            case 'STUDENT':
                $result['barChart'] = $this->getStudentBarChartDataset($range, $period);
                $result['pieChart'] = $this->getStudentPieChartDataset($range);
                $result['stats'] = $this->getStudentStats($range);
                break;
        }

        return $result;
    }


    /**
     * getRange.
     * 
     * Prepara il range dei grafici (data-inizio e data-fine)
     * in base alle scelte dell'utente (settimana-mese-anno)
     * indietro nel tempo <- move -> avanti nel tempo
     * 
     * @access	private
     * @param	request	$request	
     * @return	mixed
     */
    private function getRange(Request $request)
    {
        $period = $request->input('period');
        $move = $request->input('move');
        $prevRange = $request->input('range');

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
                'income' => $income,
                'orders' => $num_orders,
                'products' => $num_products,
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
                'orders' => $num_orders,
                'products' => $num_products,
                'users' => $num_users,
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
                $orders = ViewOrderByUser::where('user_id', $user_id)
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
                $orders = ViewOrderByUser::where('user_id', $user_id)
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
            'backgroundColor' => self::COLORS[0],
        ];

        return [
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

        $expenses = ViewOrderByUser::where('user_id', $user_id)
            ->whereBetween('date_day', [$range['from'], $range['to']])
            ->sum('total');
        $num_orders = ViewOrderByUser::where('user_id', $user_id)
            ->whereBetween('date_day', [$range['from'], $range['to']])
            ->count();
        $num_products = ViewOrderById::where('user_id', $user_id)
            ->whereBetween('date_day', [$range['from'], $range['to']])
            ->sum('num_items');
        if ($expenses) {
            return [
                'expenses' => $expenses,
                'orders' => $num_orders,
                'products' => $num_products,
            ];
        }
    }
}
