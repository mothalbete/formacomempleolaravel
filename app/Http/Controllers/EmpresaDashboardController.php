<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use App\Models\Modalidad;
use App\Models\Puesto;
use App\Models\Oferta;

class EmpresaDashboardController extends Controller
{
    public function index()
    {
        $empresa = auth()->user()->empresa;

        // Datos necesarios para el formulario de crear oferta
        $sectores = Sector::orderBy('nombre')->get();
        $modalidades = Modalidad::orderBy('nombre')->get();
        $puestos = Puesto::orderBy('nombre')->get();

        // Datos necesarios para la lista de ofertas
        $ofertas = Oferta::with(['sector', 'modalidad', 'puesto'])
            ->where('idempresa', $empresa->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('empresa.dashboard', compact(
            'empresa',
            'sectores',
            'modalidades',
            'puestos',
            'ofertas'
        ));
    }
}
