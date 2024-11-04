<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'subject_name', 'needed_grades'];

    protected $casts = [
        'needed_grades' => 'array', // Automatically cast needed_grades to array
    ];

    // Relationship to Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
