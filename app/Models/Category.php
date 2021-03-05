<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $guarded = ['id'];
    
    public static function validationRules()
    {
        return ([
            "name" => ["required"],
            "description" => ["required"],
        ]);
    }
    
    public function products(){
        return $this->hasMany(Product::class, 'category_id');
    }

}
