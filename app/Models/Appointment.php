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

    public function student()
    {
        return $this->belongsTo(User::class, 'id_student', 'id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client', 'id');
    }

    public function photoUrls()
    {
        return $this->morphMany(PhotoUrl::class, 'imageable');
    }
}
