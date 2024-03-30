<?php

namespace App\Models;

use App\Models\grades\grades;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class quiz extends Model
{
    use HasFactory;

    use HasTranslations;
    protected $guarded = [];
    public $translatable=['name'];

    public function teacher()
    {
        return $this->belongsTo(teachers::class, 'teacher_id', 'id');
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
}
