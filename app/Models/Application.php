<?php

namespace App\Models;



    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    
    class Application extends Model
    {
        use HasFactory;
    
        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'institution_id',
            'user_id',
            'course_id',
            'name',
            'surname',
            'former_school',
            'candidate_number',
            'grades',
        ];
    
        /**
         * The attributes that should be cast to native types.
         *
         * @var array<string, string>
         */
        protected $casts = [
            'grades' => 'array', // Ensure grades are stored as JSON
        ];
    
        /**
         * Relationships to other models.
         */
        public function institution()
        {
            return $this->belongsTo(Institution::class);
        }
    
        public function user()
        {
            return $this->belongsTo(User::class);
        }
    
        public function course()
        {
            return $this->belongsTo(Course::class);
        }
    }
    

