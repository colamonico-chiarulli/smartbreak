<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categories';
    protected $guarded = ['id'];

    public static function validationRules()
    {
        return ([
            "name" => ["required"],
            "description" => ["required"],
        ]);
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
