<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetakeRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'unit_exam',
        'previous_marks',
        'status',
    ];
}
