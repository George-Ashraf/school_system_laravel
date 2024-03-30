<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class gender extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable=['name'];
    protected $table="genders";
    protected $fillable=['name'];
}
