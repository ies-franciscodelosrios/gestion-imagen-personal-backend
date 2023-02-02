<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'DNI_client',
        'Date',
        'DNI_Student',
        'Treatment',
        'Protocol',
        'Consultancy',
        'Tracking',
        'Survey'
    ];
}
