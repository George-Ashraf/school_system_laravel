<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class parent_attach extends Model
{
    use HasFactory;
    protected $table="parent_attaches";
    protected $fillable=['file_name','parent_id'];
}
