<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = ['title', 'total_marks', 'passing_marks'];

    public function attempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }
}
