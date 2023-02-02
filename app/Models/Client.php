<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'DNI',
        'Name',
        'Surname',
        'Birth_Date',
        'Phone',
        'Email',
        'More_Info',
        'Life_Style',
        'Background_Health',
        'Background_Aesthetic',
        'Asthetic_Routine',
        'Hairdressing_Routine'
    ];
}
