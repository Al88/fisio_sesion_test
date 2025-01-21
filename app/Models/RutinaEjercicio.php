<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RutinaEjercicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'rutina_id',
        'ejercicio_id',
        'paciente_feedback',
        'profesional_feedback',
    ];
    protected $table = "rutinas_ejercicios";


    public function rutina()
    {
        return $this->belongsTo(Rutina::class);
    }

    public function ejercicio()
    {
        return $this->belongsTo(Ejercicio::class);
    }
}
