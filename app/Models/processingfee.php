<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class processingfee extends Model
{
    use HasFactory;
    /**
     * Get the student that owns the processingfee
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo(student::class, 'student_id', 'id');
    }
}
