<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'public_id',
        "url",
        'id_appintment',
       
    ];
    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'id_appointment');
    }
}
