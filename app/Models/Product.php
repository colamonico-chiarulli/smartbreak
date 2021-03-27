<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use Sortable;
    
    public $table = "products";
    protected $guarded = ['id'];

    public $sortable = ['name',
                        'price',
                        'num_items',
                        ];

    public static function validationRules()
    {
        return ([
            "name" => ["required"],
            "description" => ["required"],
            "price" => ["required", "numeric","min:0"],
            "num_items" => ["required", "numeric","min:0"],
            "default_daily_stock" => ["numeric","min:0"],
            "category_id" => ["required"],
            "site_id" => ['required'],
        ]);
    }

    public $appends = ['formatted_price', 'photo_url'];

    public function getFormattedPriceAttribute()
    {
        return '€ ' . str_replace('.', ',', $this->price);
    }

    public function getPhotoUrlAttribute()
    {
        return $this->photo_path ? asset('img/products/' . $this->photo_path) : null;
    }

    // relationships

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product', 'product_id', 'order_id')
            ->withPivot('quantity', 'price', 'created_at');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function site()
    {
        return $this->belongsTo(Site::class, 'site_id');
    }
}
