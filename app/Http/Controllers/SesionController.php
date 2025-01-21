<?php

namespace App\Http\Controllers;

use App\Models\Sesion;
use Illuminate\Http\Request;

class SesionController extends Controller
{
    public function index()
    {
        return response()->json(Sesion::with(['paciente.persona', 'profesional.persona'])->get(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'fecha_hora' => 'required|date',
            'paciente_id' => 'required|exists:users,id',
            'profesional_id' => 'required|exists:users,id',
        ]);

        $sesion = Sesion::create($data);
        return response()->json($sesion->load(['paciente.persona', 'profesional.persona']), 201);
    }

    public function show(Sesion $sesion)
    {
        $sesion->load(['paciente.persona', 'profesional.persona', 'sesionesRutinas.rutina']);
        return response()->json($sesion, 200);
    }

    public function update(Request $request, Sesion $sesion)
    {
        $data = $request->validate([
            'fecha_hora' => 'date',
            'paciente_id' => 'exists:pacientes,id',
            'profesional_id' => 'exists:profesionales,id',
        ]);

        $sesion->update($data);
        return response()->json($sesion->load(['paciente.persona', 'profesional.persona']), 200);
    }

    public function destroy(Sesion $sesion)
    {
        $sesion->delete();
        return response()->json(null, 204);
    }
}
