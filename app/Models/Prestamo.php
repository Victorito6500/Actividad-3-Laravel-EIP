<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'libro_id',
      'fecha_prestamo',
      'fecha_devolucion_estimada',
      'fecha_devolucion',
      'entregado'
    ];

    protected $attributes = [
      'fecha_devolucion' => null
    ];

    public function libro(){
      return $this->hasOne('App\Libro');
    }

    public function user(){
      return $this->hasOne('App\User');
    }
}
