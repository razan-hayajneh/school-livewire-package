<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'user_id'
    ];
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class,'student_teacher','student_id','teacher_id');
    }
    public function sections()
    {
        return $this->belongsToMany(Section::class,'section_student','student_id','section_id')
                    ->withPivot('first','mid','final');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
