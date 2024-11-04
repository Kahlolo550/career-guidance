<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';

    protected $fillable = ['name','faculty_id'];
    public function faculty()
{
    return $this->belongsTo(Faculty::class);
}

// In Course.php model
public function qualifications()
{
    return $this->hasMany(Qualification::class);
}
protected $casts = [
    'needed_grades' => 'array',
];




}
