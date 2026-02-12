<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmpresaPerfilController extends Controller
{
    public function update(Request $request)
    {
        $empresa = auth()->user()->empresa;

        $validated = $request->validate([
            'cif' => 'required|string|max:20',
            'telefono' => 'nullable|string|max:20',
            'nombre' => 'required|string|max:255',
            'web' => 'nullable|string|max:255',
            'persona_contacto' => 'nullable|string|max:255',
            'email_contacto' => 'nullable|email|max:255',
            'direccion' => 'nullable|string|max:255',
            'cp' => 'nullable|string|max:10',
            'ciudad' => 'nullable|string|max:255',
            'provincia' => 'nullable|string|max:255',
            'logo' => 'nullable|image|max:2048',
        ]);

        // Subida del logo
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $empresa->update($validated);

        return back()->with('success', 'Perfil actualizado correctamente.');
    }
}
