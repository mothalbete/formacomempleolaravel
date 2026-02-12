<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use App\Models\Sector;
use App\Models\Modalidad;
use App\Models\Puesto;
use Illuminate\Http\Request;

class EmpresaOfertaController extends Controller
{
    public function create()
    {
        $sectores = Sector::orderBy('nombre')->get();
        $modalidades = Modalidad::orderBy('nombre')->get();
        $puestos = Puesto::orderBy('nombre')->get();

        return view('empresa.ofertas.form-crear', compact(
            'sectores',
            'modalidades',
            'puestos'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'idsector' => 'required|exists:sectores,id',
            'idmodalidad' => 'required|exists:modalidad,id',
            'idpuesto' => 'required|exists:puestos,id',

            'titulo' => 'required|string|max:200',
            'descripcion' => 'required|string',
            'requisitos' => 'nullable|string',
            'funciones' => 'nullable|string',

            'salario_min' => 'nullable|numeric|min:0',
            'salario_max' => 'nullable|numeric|min:0',

            'tipo_contrato' => 'nullable|string|max:100',
            'jornada' => 'nullable|string|max:100',
            'ubicacion' => 'nullable|string|max:150',

            'publicar_hasta' => 'nullable|date',
            'fecha_incorporacion' => 'nullable|date',
        ]);

        // Añadimos datos automáticos
        $validated['idempresa'] = auth()->user()->empresa->id;
        $validated['fecha_publicacion'] = now();
        $validated['estado'] = 'publicada';

        Oferta::create($validated);

        return back()->with('success', 'Oferta publicada correctamente.');
    }

    public function index()
    {
        $empresaId = auth()->user()->empresa->id;

        $ofertas = Oferta::where('idempresa', $empresaId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('empresa.ofertas.lista', compact('ofertas'));
    }

    public function edit(Oferta $oferta)
    {
        // Asegurar que la oferta pertenece a la empresa logueada
        if ($oferta->idempresa !== auth()->user()->empresa->id) {
            abort(403);
        }

        $sectores = Sector::orderBy('nombre')->get();
        $modalidades = Modalidad::orderBy('nombre')->get();
        $puestos = Puesto::orderBy('nombre')->get();

        return view('empresa.ofertas.form-editar', compact(
            'oferta',
            'sectores',
            'modalidades',
            'puestos'
        ));
    }

    public function update(Request $request, Oferta $oferta)
    {
        if ($oferta->idempresa !== auth()->user()->empresa->id) {
            abort(403);
        }

        $validated = $request->validate([
            'idsector' => 'required|exists:sectores,id',
            'idmodalidad' => 'required|exists:modalidad,id',
            'idpuesto' => 'required|exists:puestos,id',

            'titulo' => 'required|string|max:200',
            'descripcion' => 'required|string',
            'requisitos' => 'nullable|string',
            'funciones' => 'nullable|string',

            'salario_min' => 'nullable|numeric|min:0',
            'salario_max' => 'nullable|numeric|min:0',

            'tipo_contrato' => 'nullable|string|max:100',
            'jornada' => 'nullable|string|max:100',
            'ubicacion' => 'nullable|string|max:150',

            'publicar_hasta' => 'nullable|date',
            'fecha_incorporacion' => 'nullable|date',
        ]);

        $oferta->update($validated);

        return redirect()->route('empresa.dashboard')
            ->with('success', 'Oferta actualizada correctamente.');
    }

    public function postulaciones(Oferta $oferta)
    {
        if ($oferta->idempresa !== auth()->user()->empresa->id) {
            abort(403);
        }

        return $oferta->candidatos()
            ->with('user')
            ->get();
    }






}
