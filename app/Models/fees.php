<?php

namespace App\Models;

use App\Models\grades\grades;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class fees extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['title'];
    protected $table = "fees";
    protected $fillable = ['title', 'fee', 'grade_id', 'classroom_id', 'year', 'notes','fee_type'];


    public function grade()
    {
        return $this->belongsTo(grades::class, 'grade_id', 'id');
    }


    public function classroom()
    {
        return $this->belongsTo(classroom::class, 'classroom_id', 'id');
    }
}
