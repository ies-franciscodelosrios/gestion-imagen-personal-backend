<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'start_time',
        'end_time',
        'dni_client',
        'dni_student',
        'treatment',
        'protocol',
        'consultancy',
        'tracking',
        'survey',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'dni_student', 'dni');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'dni_client', 'dni');
    }
    
    public function photoUrls()
    {
        return $this->morphMany(PhotoUrl::class, 'imageable');
    }
}
