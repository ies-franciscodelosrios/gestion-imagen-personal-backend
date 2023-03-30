<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'dni_client',
        'dni_student',
        'treatment',
        'protocol',
        'consultancy',
        'tracking',
        'survey',
    ];
}
