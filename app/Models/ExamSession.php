<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_session_name',
        'description',
        'start_date',
        'registration_deadline',
        'status',
    ];

    public function unit()
    {
        return $this->hasMany(Unit::class);
    }
}
