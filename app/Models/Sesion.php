<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesion extends Model
{
    use HasFactory;
    protected $table = "sesiones";

    protected $fillable = [
        'fecha_hora',
        'paciente_id',
        'profesional_id',
    ];

    public function paciente()
    {
        return $this->belongsTo(User::class);
    }

    public function profesional()
    {
        return $this->belongsTo(User::class);
    }

    public function sesionesRutinas()
    {
        return $this->hasMany(SesionRutina::class);
    }
}
