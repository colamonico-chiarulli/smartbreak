<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    //public $table = "products";
    protected $fillable = [
        "name",
        "description",
        "allergens",
        "price",
        "num_items",
        "category_id",
        "default_daily_stock",
    ];

    protected $guarded = array('id', 'password');
}