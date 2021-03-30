<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;

class AnalyticsController extends Controller
{
    public function getAnalyticsPage()
    {
        $sites = Site::all();

        $datasets = [];

        //foreach ($sites as $site) {
        $orders = Order::whereHas('user', function (Builder $query) {
            $query->where('site_id', 1);
        })->whereBetween('created_at', [
            now()->subDays(7)->toDateString(), now()->addDay()->toDateString()
        ])->get()
        ->groupBy(function ($order) {
            return $order->created_at->toDateString();
        })
        ->map(function ($group_orders) {
            return $group_orders->sum('total');
        });

        $labels = $orders->keys();

        $datasets[] = [
                'label' => 'Colamonico',
                'data' => $orders->values()
            ];
        //}


        return view('pages.analytics.index', compact('datasets', 'labels'));
    }
}
