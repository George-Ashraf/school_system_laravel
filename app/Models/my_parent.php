<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class my_parent extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $table="my_parents";
    public $translatable = ['father_name','father_job','mother_name','mother_job'];
    // 22:39 video 15
    protected $guarded=[];
}
