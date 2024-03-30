<?php

namespace App\Models;

use App\Models\grades\grades;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class sections extends Model
{
    use HasFactory;
    use HasTranslations;
    protected $table="sections";
    protected $fillable=['section_name','grade_id','class_id'];
    public $translatable=['section_name'];


    /**
     * Get the user that owns the sections
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    // 32:29 video 11
    // علاقة بين الاقسام والصفوف تجلب اسم الصف في جدول الاقسام
    public function classroom()
    {
        return $this->belongsTo(classroom::class, 'class_id', 'id');
    }
    public function grades()
    {
        return $this->belongsTo(grades::class, 'grade_id', 'id');
    }
    /**
     * The teachers that belong to the sections
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function teachers()
    {
        return $this->belongsToMany(teachers::class, 'teacher_section', 'section_id', 'teacher_id');
    }


}
