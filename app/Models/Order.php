<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    public function getTotalAttribute()
    {
        $total = 0;
        foreach ($this->products as $product) {
            $total += $product->pivot->price * $product->pivot->quantity;
        }
        return $total;
    }

    // relationships

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
