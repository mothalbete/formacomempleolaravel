<?php

namespace App\Http\Controllers;

use App\Models\Oferta;

class CandidatoDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $candidato = $user->candidato;

        // Candidaturas del candidato (incluye estado de la pivot)
        $misCandidaturas = $candidato
            ->ofertas()
            ->with('empresa')
            ->select('ofertas.*', 'candidato_oferta.estado')
            ->get();

        // Separar por estado
        $pendientes = $misCandidaturas->where('estado', 'pendiente');
        $aceptadas = $misCandidaturas->where('estado', 'aceptado');
        $rechazadas = $misCandidaturas->where('estado', 'rechazado');

        // IDs de ofertas inscritas
        $inscritas = $misCandidaturas->pluck('id');

        // Ofertas disponibles (filtradas)
        $ofertas = Oferta::with('empresa')
            ->where('estado', 'publicada')
            ->whereNotIn('id', $inscritas)
            ->orderBy('fecha_publicacion', 'desc')
            ->get();

        return view('candidato.dashboard', [
            'misCandidaturas' => $misCandidaturas,
            'pendientes' => $pendientes,
            'aceptadas' => $aceptadas,
            'rechazadas' => $rechazadas,
            'ofertas' => $ofertas
        ]);
    }
}
