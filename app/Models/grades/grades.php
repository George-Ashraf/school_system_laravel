<?php

namespace App\Models\grades;
// 1:10:29

use App\Models\sections;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class grades extends Model
{
    use HasFactory;
    use HasTranslations;
    protected $table='grades';
    public $translatable = ['name'];
    protected $fillable=['notes','name'];

//9:16 video 11

public function sections()
{
    return $this->HasMany(sections::class, 'grade_id', 'id');
}
};
