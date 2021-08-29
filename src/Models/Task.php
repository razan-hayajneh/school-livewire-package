<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'attachment' , 'section_id' , 'title'
    ];
    public function section()
    {
        return $this->belongsTo(Section::class,'section_id');
    }
}
