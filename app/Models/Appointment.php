<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = ['DNI_cliente', 'Fecha', 'DNI_alumno', 'Tratamiento', 'Protocolo', 'Asesoramiento', 'Seguimiento'];
}
