<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ejercicio extends Model
{
    use HasFactory;

    // Definir los campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'youtube_url',
    ];
    protected $table = "ejercicios";

    // Si el nombre de la tabla no es el plural del modelo, puedes especificarlo
    // protected $table = 'ejercicios';
}
