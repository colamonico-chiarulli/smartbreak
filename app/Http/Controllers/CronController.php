<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use DB;

class CronController extends Controller
{
    public function resetNumItemsProducts()
    {
        $this->checkToken();

        Product::query()->update(['num_items' => DB::raw("`default_daily_stock`")]);
    }

    private function checkToken()
    {
        if (request()->get('token') !== config('smartbreak.security_token')) {
            abort(403);
        };
    }
}
