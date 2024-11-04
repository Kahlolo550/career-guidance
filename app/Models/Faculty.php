<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model


{
    protected $table = 'faculties';
   protected $fillable = ['name','institution_id'];

    public function institution()
{
    return $this->belongsTo(Institution::class);
}

public function courses()
{
    return $this->hasMany(Course::class);
}

protected static function boot()
{
    parent::boot();

    static::deleting(function ($faculty) {
        
        $faculty->courses()->delete();
    });
}

}
