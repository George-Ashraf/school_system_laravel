<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;

class teachers extends Authenticatable
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['name'];
    protected $guarded = [];
    protected $table = "teachers";
// 41:49 video 19

    // علاقة بين المعلمين والتخصصات لجلب اسم التخصص

    public function specializations()
    {
        return $this->belongsTo(specialization::class, 'specialization_id', 'id');
    }

    // علاقة بين المعلمين والانواع لجلب جنس المعلم

    public function genders()
    {
        return $this->belongsTo(gender::class, 'gender_id', 'id');
    }

    /**
     * The sections the teachers
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    // 25:45 video 20
    public function sections()
    {
        return $this->belongsToMany(sections::class, 'teacher_section', 'teacher_id', 'section_id');
    }
}
