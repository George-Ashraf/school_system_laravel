<?php

namespace App\Models;

use App\Models\grades\grades;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fee_invoice extends Model
{
    use HasFactory;
    protected $guarded = [];
    /**
     * Get the user that owns the fee_invoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function grade()
    {
        return $this->belongsTo(grades::class, 'grade_id', 'id');
    }
    public function student()
    {
        return $this->belongsTo(student::class, 'student_id', 'id');
    }
    public function classroom()
    {
        return $this->belongsTo(classroom::class, 'classroom_id', 'id');
    }
    public function fee()
    {
        return $this->belongsTo(fees::class, 'fee_id', 'id');
    }
}
