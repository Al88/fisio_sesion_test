<?php

namespace App\Http\Controllers;

use App\Models\Ejercicio;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EjercicioController extends Controller
{
    // Mostrar todos los ejercicios
    public function index()
    {
        return Inertia::render('Ejercicios/Index', [
            'ejercicios' => Ejercicio::all(), // Enviar todos los ejercicios
        ]);
    }

    // Mostrar formulario para crear un ejercicio
    public function create()
    {
        return Inertia::render('Ejercicios/Create');
    }

    // Crear un nuevo ejercicio
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:120',
            'youtube_url' => 'required|string|max:120',
        ]);

        Ejercicio::create($data);

        return redirect()->route('ejercicios.index')->with('success', 'Ejercicio creado exitosamente.');
    }

    // Mostrar un ejercicio específico
    public function show(Ejercicio $ejercicio)
    {
        return Inertia::render('Ejercicios/Show', [
            'ejercicio' => $ejercicio,
        ]);
    }

    // Mostrar formulario para editar un ejercicio
    public function edit(Ejercicio $ejercicio)
    {
        return Inertia::render('Ejercicios/Edit', [
            'ejercicio' => $ejercicio,
        ]);
    }

    // Actualizar un ejercicio existente
    public function update(Request $request, Ejercicio $ejercicio)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:120',
            'youtube_url' => 'required|string|max:120',
        ]);

        $ejercicio->update($data);

        return redirect()->route('ejercicios.index')->with('success', 'Ejercicio actualizado exitosamente.');
    }

    // Eliminar un ejercicio
    public function destroy(Ejercicio $ejercicio)
    {
        $ejercicio->delete();

        return redirect()->route('ejercicios.index')->with('success', 'Ejercicio eliminado exitosamente.');
    }
}
