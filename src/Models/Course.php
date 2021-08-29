<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    protected $fillable = [
        'name',
    ];
    use HasFactory;
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class,'course_teacher','course_id','teacher_id');
    }
    public function students()
    {
        return $this->belongsToMany(Student::class,'course_student','course_id','student_id');
    }
    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
