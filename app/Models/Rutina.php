<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rutina extends Model
{
    use HasFactory;

    protected $fillable = [
        'descripcion',
        'profesional_id',
    ];
    protected $table = "rutinas";

    public function profesional()
    {
        return $this->belongsTo(User::class);
    }

    public function sesionesRutinas()
    {
        return $this->hasMany(SesionRutina::class);
    }

    public function rutinasEjercicios()
    {
        return $this->hasMany(RutinaEjercicio::class);
    }

    public function ejercicios()
    {
        return $this->belongsToMany(Ejercicio::class, 'rutinas_ejercicios', 'rutina_id', 'ejercicio_id');
    }
}
