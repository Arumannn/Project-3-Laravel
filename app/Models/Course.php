<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model {
    use HasFactory;

    protected $primaryKey = 'course_id';
    protected $fillable = ['course_name', 'credits'];

    public function students() {
        return $this->belongsToMany(Student::class, 'takes', 'course_id', 'student_id')
                    ->withPivot('enroll_date');
    }
}
