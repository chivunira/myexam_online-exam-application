<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemarkRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'unit_id',
        'reason',
        'previous_marks',
        'status',
        'revised_marks',
        'assigned_lec',
        'feedback',
    ];
}
