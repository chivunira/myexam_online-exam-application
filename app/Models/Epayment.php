<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Epayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'transaction_id',
        'amount',
        'phone_number',
        'status',
    ];

    public function getContent()
    {
        return $this->content;
    }
}
