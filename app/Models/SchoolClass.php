<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class SchoolClass extends Model
{
    use HasFactory;
    use Sortable;

    public $timestamps = false;

    protected $table = 'classes';
    protected $guarded = ['id'];

    public $sortable = [
        'year',
        'course',
    ];

    public static function validationRules()
    {
        return ([
            "year" => ["required", "integer", "between:1,5"],
            "section" => ["required", "string", "max:1"],
            "course" => ["required", "string", "min:3", "max:3"],
            "site_id" => ["required"],
        ]);
    }

    public function setSectionAttribute($value)
    {
        $this->attributes['section'] = strtoupper($value);
    }

    public function setCourseAttribute($value)
    {
        $this->attributes['course'] = strtoupper($value);
    }

    protected $appends = ['name'];

    public function getNameAttribute()
    {
        return $this->attributes['year'] . $this->attributes['course'] . "-" . $this->attributes['section'];
    }

    public function site()
    {
        return $this->belongsTo(Site::class, 'site_id');
    }
}
