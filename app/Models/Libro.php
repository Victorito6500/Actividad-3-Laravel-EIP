<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;

    protected $fillable = [
      'titulo',
      'autor',
      'descripcion',
      'anio_publicacion',
      'genero',
      'disponible'
    ];

    public function prestamo(){
      return $this->hasOne('App\Prestamo');
    }
}
