<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'user_id'
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class,'student_teacher','teacher_id','student_id');
    }
    public function sections()
    {
        return $this->hasMany(Section::class,'teacher_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
