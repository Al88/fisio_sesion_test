<?php

namespace App\Http\Controllers;

use App\Models\SesionRutina;
use Illuminate\Http\Request;

class SesionRutinaController extends Controller
{
    public function index()
    {
        return response()->json(SesionRutina::with(['sesion', 'rutina'])->get(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'sesion_id' => 'required|exists:sesiones,id',
            'rutina_id' => 'required|exists:rutinas,id',
            'fecha_hora' => 'required|date',
        ]);

        $sesionRutina = SesionRutina::create($data);
        return response()->json($sesionRutina->load(['sesion', 'rutina']), 201);
    }

    public function show(SesionRutina $sesionRutina)
    {
        $sesionRutina->load(['sesion', 'rutina']);
        return response()->json($sesionRutina, 200);
    }

    public function update(Request $request, SesionRutina $sesionRutina)
    {
        $data = $request->validate([
            'fecha_hora' => 'date',
        ]);

        $sesionRutina->update($data);
        return response()->json($sesionRutina->load(['sesion', 'rutina']), 200);
    }

    public function destroy(SesionRutina $sesionRutina)
    {
        $sesionRutina->delete();
        return response()->json(null, 204);
    }

    // Método para guardar el feedback del paciente
    public function savePacienteFeedback(Request $request, SesionRutina $sesionRutina)
    {
        $data = $request->validate([
            'paciente_feedback' => 'required|string|max:120',
        ]);

        $sesionRutina->update($data);
        return response()->json(['message' => 'Paciente feedback updated successfully', 'sesionRutina' => $sesionRutina], 200);
    }

    // Método para guardar el feedback del profesional
    public function saveProfesionalFeedback(Request $request, SesionRutina $sesionRutina)
    {
        $data = $request->validate([
            'profesional_feedback' => 'required|string|max:120',
        ]);

        $sesionRutina->update($data);
        return response()->json(['message' => 'Profesional feedback updated successfully', 'sesionRutina' => $sesionRutina], 200);
    }


    public function saveEjercicioPacienteFeedback(Request $request, SesionRutina $sesionRutina, $ejercicioId)
    {
        $data = $request->validate([
            'paciente_feedback' => 'required|string|max:120',
        ]);

        // Verificar que el ejercicio esté asociado a la rutina dentro de la sesión
        $rutinaEjercicio = $sesionRutina->rutina->rutinasEjercicios()
            ->where('ejercicio_id', $ejercicioId)
            ->first();

        if (!$rutinaEjercicio) {
            return response()->json(['error' => 'Ejercicio no asociado a esta rutina'], 404);
        }

        // Actualizar el feedback del paciente en el ejercicio
        $rutinaEjercicio->update([
            'paciente_feedback' => $data['paciente_feedback'],
        ]);

        return response()->json(['message' => 'Feedback del paciente actualizado correctamente', 'rutinaEjercicio' => $rutinaEjercicio], 200);
    }


    public function saveEjercicioProfesionalFeedback(Request $request, SesionRutina $sesionRutina, $ejercicioId)
    {
        $data = $request->validate([
            'profesional_feedback' => 'required|string|max:120',
        ]);

        // Verificar que el ejercicio esté asociado a la rutina dentro de la sesión
        $rutinaEjercicio = $sesionRutina->rutina->rutinasEjercicios()
            ->where('ejercicio_id', $ejercicioId)
            ->first();

        if (!$rutinaEjercicio) {
            return response()->json(['error' => 'Ejercicio no asociado a esta rutina'], 404);
        }

        // Actualizar el feedback del paciente en el ejercicio
        $rutinaEjercicio->update([
            'profesional_feedback' => $data['profesional_feedback'],
        ]);

        return response()->json(['message' => 'Feedback del paciente actualizado correctamente', 'rutinaEjercicio' => $rutinaEjercicio], 200);
    }
}
