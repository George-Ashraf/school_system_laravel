<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class img extends Model
{
    use HasFactory;
    protected $table='imgs';
    protected $fillable=['filename','imageable_id','imageable_type'];
// 21:14 video 24
    public function imageable()
    {
        return $this->morphTo();
    }
}
