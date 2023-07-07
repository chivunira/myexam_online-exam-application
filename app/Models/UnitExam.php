<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitExam extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_id',
        'exam_date',
        'exam_venue',
        'exam_session_id',
    ];
}
