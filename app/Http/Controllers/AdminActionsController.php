<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Oferta;

class AdminActionsController extends Controller
{
    /* ============================
       VALIDAR EMPRESA
    ============================ */
    public function validarEmpresa($id)
    {
        $empresa = Empresa::findOrFail($id);
        $empresa->estado = 'validada';
        $empresa->save();

        return back()->with('success', 'La empresa ha sido validada correctamente.');
    }

    /* ============================
       RECHAZAR EMPRESA
    ============================ */
    public function rechazarEmpresa($id)
    {
        $empresa = Empresa::findOrFail($id);
        $empresa->estado = 'rechazada';
        $empresa->save();

        return back()->with('success', 'La empresa ha sido rechazada.');
    }

    /* ============================
       VALIDAR OFERTA
    ============================ */
    public function validarOferta($id)
    {
        $oferta = Oferta::findOrFail($id);
        $oferta->estado = 'publicada'; // o "aprobada" si prefieres
        $oferta->fecha_publicacion = now();
        $oferta->save();

        return back()->with('success', 'La oferta ha sido aprobada y publicada.');
    }

    /* ============================
       RECHAZAR OFERTA
    ============================ */
    public function rechazarOferta($id)
    {
        $oferta = Oferta::findOrFail($id);
        $oferta->estado = 'rechazada';
        $oferta->save();

        return back()->with('success', 'La oferta ha sido rechazada.');
    }
}
