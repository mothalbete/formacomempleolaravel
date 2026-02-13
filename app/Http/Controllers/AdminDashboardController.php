<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Oferta;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        /* ============================================================
           FILTROS GENERALES
        ============================================================ */

        $search  = $request->input('search');   // texto de búsqueda
        $fecha   = $request->input('fecha');    // fecha seleccionada
        $carpeta = $request->input('carpeta');  // carpeta activa (pendiente, validada, etc.)

        /* ============================================================
           EMPRESAS — Fechas dinámicas por carpeta
        ============================================================ */

        $fechasEmpresasPendientes = Empresa::where('estado', 'pendiente')
            ->pluck('created_at')
            ->map(fn($f) => $f->format('Y-m-d'))
            ->unique()
            ->sort()
            ->values();

        $fechasEmpresasValidadas = Empresa::where('estado', 'validada')
            ->pluck('updated_at')
            ->map(fn($f) => $f->format('Y-m-d'))
            ->unique()
            ->sort()
            ->values();

        $fechasEmpresasRechazadas = Empresa::where('estado', 'rechazada')
            ->pluck('updated_at')
            ->map(fn($f) => $f->format('Y-m-d'))
            ->unique()
            ->sort()
            ->values();

        /* ============================================================
           EMPRESAS — Carpetas con filtros aplicados
        ============================================================ */

        $empresasPendientes = Empresa::where('estado', 'pendiente')
            ->when($search, fn($q) =>
                $q->where('nombre', 'LIKE', "%$search%")
                  ->orWhere('email_contacto', 'LIKE', "%$search%")
            )
            ->when($fecha, fn($q) =>
                $q->whereDate('created_at', $fecha)
            )
            ->get();

        $empresasValidadas = Empresa::where('estado', 'validada')
            ->when($search, fn($q) =>
                $q->where('nombre', 'LIKE', "%$search%")
                  ->orWhere('email_contacto', 'LIKE', "%$search%")
            )
            ->when($fecha, fn($q) =>
                $q->whereDate('updated_at', $fecha)
            )
            ->get();

        $empresasRechazadas = Empresa::where('estado', 'rechazada')
            ->when($search, fn($q) =>
                $q->where('nombre', 'LIKE', "%$search%")
                  ->orWhere('email_contacto', 'LIKE', "%$search%")
            )
            ->when($fecha, fn($q) =>
                $q->whereDate('updated_at', $fecha)
            )
            ->get();

        /* ============================================================
           OFERTAS — Fechas dinámicas por carpeta
        ============================================================ */

        $fechasOfertasPendientes = Oferta::where('estado', 'pendiente')
            ->pluck('created_at')
            ->map(fn($f) => $f->format('Y-m-d'))
            ->unique()
            ->sort()
            ->values();

        $fechasOfertasAprobadas = Oferta::where('estado', 'publicada')
            ->pluck('fecha_publicacion')
            ->filter()
            ->map(fn($f) => $f->format('Y-m-d'))
            ->unique()
            ->sort()
            ->values();

        $fechasOfertasRechazadas = Oferta::where('estado', 'rechazada')
            ->pluck('updated_at')
            ->map(fn($f) => $f->format('Y-m-d'))
            ->unique()
            ->sort()
            ->values();

        /* ============================================================
           OFERTAS — Carpetas con filtros aplicados
        ============================================================ */

        $ofertasPendientes = Oferta::where('estado', 'pendiente')
            ->with('empresa')
            ->when($search, fn($q) =>
                $q->where('titulo', 'LIKE', "%$search%")
                  ->orWhereHas('empresa', fn($e) =>
                      $e->where('nombre', 'LIKE', "%$search%")
                  )
            )
            ->when($fecha, fn($q) =>
                $q->whereDate('created_at', $fecha)
            )
            ->get();

        $ofertasAprobadas = Oferta::where('estado', 'publicada')
            ->with('empresa')
            ->when($search, fn($q) =>
                $q->where('titulo', 'LIKE', "%$search%")
                  ->orWhereHas('empresa', fn($e) =>
                      $e->where('nombre', 'LIKE', "%$search%")
                  )
            )
            ->when($fecha, fn($q) =>
                $q->whereDate('fecha_publicacion', $fecha)
            )
            ->get();

        $ofertasRechazadas = Oferta::where('estado', 'rechazada')
            ->with('empresa')
            ->when($search, fn($q) =>
                $q->where('titulo', 'LIKE', "%$search%")
                  ->orWhereHas('empresa', fn($e) =>
                      $e->where('nombre', 'LIKE', "%$search%")
                  )
            )
            ->when($fecha, fn($q) =>
                $q->whereDate('updated_at', $fecha)
            )
            ->get();

        /* ============================================================
           USUARIOS — Fechas dinámicas
        ============================================================ */

        $fechasCandidatos = User::where('role', 'candidato')
            ->pluck('created_at')
            ->map(fn($f) => $f->format('Y-m-d'))
            ->unique()
            ->sort()
            ->values();

        $fechasUsuariosEmpresa = User::where('role', 'empresa')
            ->pluck('created_at')
            ->map(fn($f) => $f->format('Y-m-d'))
            ->unique()
            ->sort()
            ->values();

        /* ============================================================
           USUARIOS — Carpetas con filtros aplicados
        ============================================================ */

        $candidatos = User::where('role', 'candidato')
            ->when($search, fn($q) =>
                $q->where('name', 'LIKE', "%$search%")
                  ->orWhere('email', 'LIKE', "%$search%")
            )
            ->when($fecha, fn($q) =>
                $q->whereDate('created_at', $fecha)
            )
            ->get();

        $empresasUsuarios = User::where('role', 'empresa')
            ->with('empresa')
            ->when($search, fn($q) =>
                $q->where('name', 'LIKE', "%$search%")
                  ->orWhere('email', 'LIKE', "%$search%")
                  ->orWhereHas('empresa', fn($e) =>
                      $e->where('nombre', 'LIKE', "%$search%")
                  )
            )
            ->when($fecha, fn($q) =>
                $q->whereDate('created_at', $fecha)
            )
            ->get();

        /* ============================================================
           RETORNAR TODO A LA VISTA
        ============================================================ */

        return view('admin.dashboard', compact(

            // EMPRESAS
            'empresasPendientes',
            'empresasValidadas',
            'empresasRechazadas',
            'fechasEmpresasPendientes',
            'fechasEmpresasValidadas',
            'fechasEmpresasRechazadas',

            // OFERTAS
            'ofertasPendientes',
            'ofertasAprobadas',
            'ofertasRechazadas',
            'fechasOfertasPendientes',
            'fechasOfertasAprobadas',
            'fechasOfertasRechazadas',

            // USUARIOS
            'candidatos',
            'empresasUsuarios',
            'fechasCandidatos',
            'fechasUsuariosEmpresa',

            // FILTROS
            'search',
            'fecha',
            'carpeta'
        ));
    }
}
