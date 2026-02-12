<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use Illuminate\Http\Request;

class CandidatoOfertaController extends Controller
{
    /**
     * Muestra todas las ofertas disponibles para el candidato.
     */
    public function index()
    {
        $user = auth()->user();
        $candidato = $user->candidato;

        // IDs de ofertas en las que ya está inscrito
        $inscritas = $candidato->ofertas()->pluck('oferta_id');

        // Ofertas disponibles (excluyendo inscritas)
        $ofertas = Oferta::with('empresa')
            ->where('estado', 'publicada')
            ->whereNotIn('id', $inscritas)
            ->orderBy('fecha_publicacion', 'desc')
            ->get();

        return view('candidato.partials.ofertas', compact('ofertas'));
    }

    /**
     * Inscribirse en una oferta.
     */
    public function inscribirse($id)
    {
        $user = auth()->user();
        $candidato = $user->candidato;

        if ($candidato->ofertas->contains($id)) {
            return back()->with('error', 'Ya estás inscrito en esta oferta.');
        }

        $candidato->ofertas()->attach($id);

        return back()->with('success', 'Te has inscrito correctamente en la oferta.');
    }

    /**
     * Retirarse de una oferta.
     */
    public function retirarse($id)
    {
        $user = auth()->user();
        $candidato = $user->candidato;

        if (! $candidato->ofertas->contains($id)) {
            return back()->with('error', 'No estabas inscrito en esta oferta.');
        }

        $candidato->ofertas()->detach($id);

        return back()->with('success', 'Has retirado tu candidatura correctamente.');
    }
}
