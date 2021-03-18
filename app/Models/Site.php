<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $tables = 'sites';

    protected $guarded = ['id'];

    public static function validationRules()
    {
        return ([
            "name" => ["required"],
        ]);
    }
}
