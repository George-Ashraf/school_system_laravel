<?php

namespace App\Models;

use App\Models\grades\grades;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class zoom extends Model
{
    use HasFactory;
// 26:00 video 43
// protected $guarded=['integration'];
    public $fillable= ['grade_id','classroom_id','section_id','user_id','meeting_id','topic','start_at','duration','password','start_url','join_url','integration'];

    public function grade()
    {
        return $this->belongsTo(grades::class, 'grade_id', 'id');
    }

    public function classroom()
    {
        return $this->belongsTo(classroom::class, 'classroom_id', 'id');
    }

    public function section()
    {
        return $this->belongsTo(sections::class, 'section_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(user::class, 'user_id', 'id');
    }
}
