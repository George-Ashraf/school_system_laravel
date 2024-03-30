<?php

namespace App\Models;

use App\Models\grades\grades;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class classroom extends Model
{
    use HasTranslations;
    use HasFactory;
    public $translatable=['class_name'];
    protected $table="classrooms";
    protected $fillable=['class_name','grade_id'];

      public function grades()
    {
        return $this->BelongsTo(grades::class, 'grade_id', 'id');
    }
}
// video 8 9:59
    //  * Get the user that owns the classroom
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    //  */
    // public function user(): BelongsTo
    // {
    //     return $this->belongsTo(User::class, 'foreign_key', 'other_key');
    // }
