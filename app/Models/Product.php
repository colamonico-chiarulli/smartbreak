<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $table = "products";
    protected $guarded = array('id');

    public $appends = ['formatted_price', 'photo_url'];

    public function getFormattedPriceAttribute(){
        return '€ '.str_replace('.', ',', $this->price);
    }

    public function getPhotoUrlAttribute(){
        return asset('img/products/'.$this->photo_path);
    }


}
