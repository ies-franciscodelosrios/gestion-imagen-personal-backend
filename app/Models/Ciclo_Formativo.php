<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciclo_Formativo extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'short_name',
        'long_name',
        'descripcion',
    ];

    public function photoUrls()
    {
        return $this->morphMany(PhotoUrl::class, 'imageable');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }


}
