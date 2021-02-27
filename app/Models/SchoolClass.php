<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'classes';
    protected $guarded = ['id'];
}
