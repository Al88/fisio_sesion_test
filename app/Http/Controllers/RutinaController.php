<?php

namespace App\Http\Controllers;

use App\Models\Ejercicio;
use App\Models\Rutina;
use App\Models\RutinaEjercicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class RutinaController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('Rutinas/index', [
            'rutinas' => Rutina::get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'descripcion' => 'required|string',
            'ejercicios' => 'required|array', // Lista de ejercicios
        ]);

        $rutina = Rutina::create([
            'descripcion' => $data['descripcion'],
            'profesional_id' => Auth::user()->id,
        ]);

        foreach ($data['ejercicios'] as $ejercicio) {
            RutinaEjercicio::create([
                'rutina_id' => $rutina->id,
                'ejercicio_id' => $ejercicio['id'],
            ]);
        }

        return redirect()->route('rutinas.index')->with('success', 'Rutina creada exitosamente.');

    }

    public function show(Rutina $rutina)
    {
        $rutina->load('rutinasEjercicios.ejercicio');

        return Inertia::render('Rutinas/edit', [
            'rutina' => [
                'id' => $rutina->id,
                'descripcion' => $rutina->descripcion,
                'ejercicios' => $rutina->rutinasEjercicios->map(fn ($re) => $re->ejercicio->only(['id', 'nombre'])),
            ],
            'ejerciciosDisponibles' => Ejercicio::select('id', 'nombre')->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Rutinas/create', [
            'ejerciciosDisponibles' => Ejercicio::select('id', 'nombre')->get(),
        ]);
    }

    public function update(Request $request, Rutina $rutina)
    {
        $data = $request->validate([
            'descripcion' => 'string',
            'ejercicios' => 'array',
        ]);

        $rutina->update($data);

        if (isset($data['ejercicios'])) {
            // Actualizar los ejercicios de la rutina
            RutinaEjercicio::where('rutina_id', $rutina->id)->delete();

            foreach ($data['ejercicios'] as $ejercicio) {
                RutinaEjercicio::create([
                    'rutina_id' => $rutina->id,
                    'ejercicio_id' => $ejercicio["id"],
                ]);
            }
        }
        return redirect()->route('rutinas.index')->with('success', 'Rutina actualizada exitosamente.');
    }

    public function destroy(Rutina $rutina)
    {
        $rutina->rutinasEjercicios()->delete(); // Elimina las relaciones
        $rutina->delete();
        return redirect()->route('rutinas.index')->with('success', 'Rutina eliminada exitosamente.');
    }
}
