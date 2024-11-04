<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admission extends Model


{

    protected $table = 'admissions';
    protected $fillable = [
        'institution_id',
        'title',
         'document',
        'details',
        'start_date',
        'end_date',
    ];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    // In your Admission model
public function getFileUrlAttribute()
{
    return asset('storage/' . $this->file_path); // Adjust the path as necessary
}

}


