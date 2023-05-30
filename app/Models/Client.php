<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'dni',
        'name',
        'surname',
        'birth_date',
        'phone',
        'email',
        'more_info',
        'life_style',
        'background_health',
        'background_aesthetic',
        'asthetic_routine',
        'hairdressing_routine',
    ];
    
    public function photoUrls()
    {
        return $this->morphMany(PhotoUrl::class, 'imageable');
    }
}
