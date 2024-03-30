<?php

namespace App\Models;

use App\Models\grades\grades;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class student extends Authenticatable
{
    use SoftDeletes;
    use HasFactory;
    use HasTranslations;
    protected $table = "students";
    public $translatable = ['name'];
    protected $guarded = [];


    // 20:00 video 23
    public function gender()
    {
        return $this->belongsTo(gender::class, 'gender_id', 'id');
    }
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
    // 22:40 video 24
    // علاقة بين الطلاب والصور لجلب اسم الصور  في جدول الطلاب

    public function images()
    {
        return $this->morphMany(img::class, 'imageable');
    }
    public function nationality()
    {
        return $this->belongsTo(nationality::class, 'nationalitie_id', 'id');
    }

    public function myparent()
    {
        return $this->belongsTo(my_parent::class, 'parent_id', 'id');
    }

    // 56:25 video 34


    // علاقة بين جدول سدادت الطلاب وجدول الطلاب لجلب اجمالي المدفوعات والمتبقي
    public function student_account()
    {
        return $this->hasMany(student_account::class, 'student_id', 'id');
    }

        //    20:40 video 36
    // علاقة بين جدول الطلاب وجدول الحضور
    public function attendance()
    {
        return $this->hasMany(attendance::class, 'student_id', 'id');
    }
}
