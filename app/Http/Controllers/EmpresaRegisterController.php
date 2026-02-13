<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;

class EmpresaRegisterController extends Controller
{
    /**
     * Guarda los datos adicionales de la empresa
     * después de que el usuario haya elegido el rol "empresa".
     */
    public function storeExtra(Request $request)
    {
        // Validación de los datos de empresa
        $request->validate([
            'cif' => 'required|string|max:20|unique:empresas,cif',
            'nombre' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'web' => 'nullable|string|max:255',
            'persona_contacto' => 'nullable|string|max:255',
            'email_contacto' => 'nullable|email|max:255',
            'direccion' => 'nullable|string|max:255',
            'cp' => 'nullable|string|max:10',
            'ciudad' => 'nullable|string|max:255',
            'provincia' => 'nullable|string|max:255',
            'logo' => 'nullable|image|max:2048',
        ]);

        $user = auth()->user();

        // 🔥 ASIGNAR ROL AL USUARIO
        $user->role = 'empresa';
        $user->save();

        // 🔥 REFRESCAR SESIÓN PARA EVITAR REDIRECCIÓN AL LOGIN
        auth()->login($user);

        // Crear registro en la tabla empresa
        $empresa = new Empresa();
        $empresa->user_id = $user->id;
        $empresa->cif = $request->cif;
        $empresa->nombre = $request->nombre;
        $empresa->telefono = $request->telefono;
        $empresa->web = $request->web;
        $empresa->persona_contacto = $request->persona_contacto;
        $empresa->email_contacto = $request->email_contacto;
        $empresa->direccion = $request->direccion;
        $empresa->cp = $request->cp;
        $empresa->ciudad = $request->ciudad;
        $empresa->provincia = $request->provincia;

        // Guardar logo si existe
        if ($request->hasFile('logo')) {
            $empresa->logo = $request->file('logo')->store('logos', 'public');
        }

        $empresa->save();

        return redirect()->route('empresa.dashboard');
    }
}
