<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrdersTimeRangeCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $time_range = config('smartbreak.orders_timerange');
        $current_hour = now()->hour;
        //$current_hour = 9;

        if(
            $time_range['enabled'] &&
            ($current_hour <= $time_range['from'] || $current_hour >= $time_range['to'])
        ){
            abort_if($request->ajax(), 403);
            return redirect('student-orders');
        }

        return $next($request);
    }
}
