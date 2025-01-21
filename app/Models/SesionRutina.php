<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SesionRutina extends Model
{
    use HasFactory;
    protected $table = "sesiones_rutinas";

    protected $fillable = [
        'sesion_id',
        'rutina_id',
        'paciente_feedback',
        'profesional_feedback',
        'fecha_hora',
    ];

    public function sesion()
    {
        return $this->belongsTo(Sesion::class);
    }

    public function rutina()
    {
        return $this->belongsTo(Rutina::class);
    }
}
