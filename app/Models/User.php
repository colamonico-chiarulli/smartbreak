<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function class()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public static function validationRules()
    {
        return ([
            "first_name" => ["required"],
            "last_name" => ["required"],
            "email" => ["required"],
            //Deve Contenere almeno 1 Mauscola, 1minuscola, 1 numero e 1 carattere speciale - minimo 8 caratteri
            "password" => ["required", "min:8", "regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/"],
            "password_confimation" => ["required_with:password","same:password","min:8"],
            "role" => ["required"],
        ]);
    }
}
