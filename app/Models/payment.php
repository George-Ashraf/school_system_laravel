<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;

    /**
     * Get the student te payment
     *
     * @return \Illuminate\studebase\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo(student::class, 'student_id', 'id');
    }
}
