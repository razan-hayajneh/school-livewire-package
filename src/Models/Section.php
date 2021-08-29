<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $fillable = [
        'section_number',
'course_id',
'teacher_id'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class,'course_id');
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function students()
    {
        return $this->belongsToMany(Student::class , 'section_student','section_id','student_id')
                     ->withPivot('first','mid','final');;
    }
}
