<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use Illuminate\Http\Request;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notas = Nota::orderBy('created_at', 'desc')->get();

        return response()->json($notas);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'contenido' => 'required|string|max:1000',
        ]);

        $nota = Nota::create([
            'contenido' => $request->contenido,
        ]);

        return response()->json($nota, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Nota $nota)
    {
        // route-model binding provides the nota instance
        return response()->json($nota);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nota $nota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nota $nota)
    {
        $request->validate([
            'contenido' => 'required|string|max:1000',
        ]);

        $nota->contenido = $request->contenido;
        $nota->save();

        return response()->json($nota);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nota $nota)
    {
        $nota->delete();

        return response()->json(['message' => 'Nota eliminada'], 200);
    }

    public function buscar($patron)
    {
        $notas = Nota::where('contenido', 'LIKE', "%{$patron}%")
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'patron' => $patron,
            'coincidencias' => $notas,
            'total' => $notas->count(),
        ]);

    }

    public function resumen()
    {
        $notas = Nota::all();

        if ($notas->isEmpty()) {
            return response()->json([
                'total' => 0,
                'distintas' => 0,
                'masLarga' => 0,
                'masCorta' => 0,
                'largoPromedio' => 0,
            ]);
        }

        $contenidos = $notas->pluck('contenido');
        $largos = $contenidos->map(fn ($c) => strlen($c));

        return response()->json([
            'total' => $notas->count(),
            'distintas' => $contenidos->unique()->count(),
            'masLarga' => $largos->max(),
            'masCorta' => $largos->min(),
            'largoPromedio' => round($largos->avg(), 2),
        ]);
    }
}
