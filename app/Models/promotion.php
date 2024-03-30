<?php

namespace App\Models;

use App\Models\grades\grades;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class promotion extends Model
{
    use HasFactory;
    protected $table = "promotions";
    protected $guarded = [];
    // public function student()
    // {
    //     return $this->belongsTo(student::class, 'student_id', 'id');
    // }
    public function f_grade()
    {
        return $this->belongsTo(grades::class, 'from_grade', 'id');
    }
    public function f_classroom()
    {
        return $this->belongsTo(classroom::class, 'from_classroom', 'id');
    }
    public function f_section()
    {
        return $this->belongsTo(sections::class, 'from_section', 'id');
    }

    public function t_grade()
    {
        return $this->belongsTo(grades::class, 'to_grade', 'id');
    }
    public function t_classroom()
    {
        return $this->belongsTo(classroom::class, 'to_classroom', 'id');
    }
    public function t_section()
    {
        return $this->belongsTo(sections::class, 'to_section', 'id');
    }
}
