<?php

namespace App\Http\Controllers;

use App\Models\Oferta;

class CandidatoDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $candidato = $user->candidato;

        // Candidaturas del candidato
        $misCandidaturas = $candidato
            ->ofertas()
            ->with('empresa')
            ->get();

        // IDs de ofertas inscritas
        $inscritas = $misCandidaturas->pluck('id');

        // Ofertas disponibles (filtradas)
        $ofertas = Oferta::with('empresa')
            ->where('estado', 'publicada')
            ->whereNotIn('id', $inscritas)
            ->orderBy('fecha_publicacion', 'desc')
            ->get();

        return view('candidato.dashboard', compact('misCandidaturas', 'ofertas'));
    }
}
