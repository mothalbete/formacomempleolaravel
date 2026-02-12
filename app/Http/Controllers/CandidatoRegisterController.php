<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CandidatoRegisterController extends Controller
{
    /**
     * Asigna el rol elegido por el usuario después del registro genérico.
     * Ahora: si elige candidato → NO asigna rol todavía, lo envía a completar perfil.
     */
    public function assignRole(Request $request)
    {
        // Validar que el rol es uno de los permitidos
        $request->validate([
            'role' => 'required|in:candidato,empresa',
        ]);

        $user = auth()->user();

        // Si elige candidato → ir al formulario extra ANTES de asignar rol
        if ($request->role === 'candidato') {
            return redirect()->route('candidato.completar-perfil');
        }

        // Si elige empresa → asignar rol y enviar al formulario extra de empresa
        $user->role = 'empresa';
        $user->save();

        return redirect()->route('empresa.register.extra');
    }
}
