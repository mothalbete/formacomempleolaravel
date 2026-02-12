<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidato;
use Illuminate\Support\Facades\Storage;

class CandidatoPerfilController extends Controller
{
    /**
     * Guarda los datos extra del candidato y asigna el rol.
     */
    public function store(Request $request)
    {
        $request->validate([
            'telefono'         => 'required|string|max:20',
            'direccion'        => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'cv'               => 'required|mimes:pdf|max:2048',
            'experiencia'      => 'nullable|string',
        ]);

        $user = auth()->user();

        // Subir CV
        $cvPath = $request->file('cv')->store('cvs', 'public');

        // Crear perfil de candidato
        Candidato::create([
            'idusuario'        => $user->id,
            'telefono'         => $request->telefono,
            'direccion'        => $request->direccion,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'cv'               => $cvPath,
            'experiencia'      => $request->experiencia,
        ]);

        // Asignar rol candidato
        $user->role = 'candidato';
        $user->save();

        return redirect()->route('candidato.dashboard');
    }

    /**
     * Actualiza el perfil del candidato.
     */
    public function update(Request $request)
    {
        $request->validate([
            'telefono'         => 'required|string|max:20',
            'direccion'        => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'cv'               => 'nullable|mimes:pdf|max:2048',
            'experiencia'      => 'nullable|string',
        ]);

        $user = auth()->user();
        $candidato = $user->candidato;

        // Si sube un nuevo CV, reemplazar el anterior
        if ($request->hasFile('cv')) {

            // Borrar CV anterior si existe
            if ($candidato->cv && Storage::disk('public')->exists($candidato->cv)) {
                Storage::disk('public')->delete($candidato->cv);
            }

            $cvPath = $request->file('cv')->store('cvs', 'public');
            $candidato->cv = $cvPath;
        }

        // Actualizar el resto de campos
        $candidato->telefono         = $request->telefono;
        $candidato->direccion        = $request->direccion;
        $candidato->fecha_nacimiento = $request->fecha_nacimiento;
        $candidato->experiencia      = $request->experiencia;

        $candidato->save();

        return redirect()->route('candidato.dashboard')
                         ->with('success', 'Perfil actualizado correctamente.');
    }
}
