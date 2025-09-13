<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model {
    use HasFactory;

    protected $primaryKey = 'student_id';
    protected $fillable = ['entry_year', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function courses() {
        return $this->belongsToMany(Course::class, 'takes', 'student_id', 'course_id')
                    ->withPivot('enroll_date');
    }
}
