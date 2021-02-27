<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $table = "products";
    protected $guarded = ['id'];

    public static function validationRules()
    {
        return ([
            "name" => ["required"],
            "description" => ["required"],
            "price" => ["required", "numeric"],
            "num_items" => ["required", "numeric"],
            "default_daily_stock" => ["numeric"],
            "category_id" => ["required"],
        ]);
    }

    public $appends = ['formatted_price', 'photo_url'];

    public function getFormattedPriceAttribute()
    {
        return '€ ' . str_replace('.', ',', $this->price);
    }

    public function getPhotoUrlAttribute()
    {
        return asset('img/products/' . $this->photo_path);
    }

    // relationships

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product', 'product_id', 'order_id')
            ->withPivot('quantity', 'price', 'created_at');
    }
}
