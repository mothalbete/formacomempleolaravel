<div x-data="{ open: false }" 
     class="border border-gray-300 rounded-xl overflow-hidden bg-gray-50 shadow-sm">

    {{-- CABECERA --}}
    <button @click="open = !open"
        class="w-full flex justify-between items-center p-4 bg-gray-100 hover:bg-gray-200 transition">

        <div class="text-left">
            <h4 class="text-lg font-semibold text-gray-900">
                {{ $empresa->nombre }}
            </h4>

            <p class="text-gray-600 text-xs mt-1">
                CIF: {{ $empresa->cif }} · {{ $empresa->ciudad }}
            </p>
        </div>

        {{-- ICONOS --}}
        <svg x-show="!open" class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>

        <svg x-show="open" class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4" />
        </svg>
    </button>

    {{-- CONTENIDO --}}
    <div x-show="open" x-collapse class="p-5 bg-white text-sm">

        {{-- Información completa de empresa --}}
        <x-empresa-info :empresa="$empresa" />

        {{-- BOTONES DE ACCIÓN --}}
        <div class="mt-6 flex gap-3">

            @if ($carpeta === 'pendientes')
                {{-- Validar --}}
                <form method="POST" action="{{ route('admin.empresas.validar', $empresa->id) }}">
                    @csrf
                    <button class="px-4 py-2 bg-green-600 text-white rounded-lg text-xs">
                        Validar empresa
                    </button>
                </form>

                {{-- Rechazar --}}
                <form method="POST" action="{{ route('admin.empresas.rechazar', $empresa->id) }}">
                    @csrf
                    <button class="px-4 py-2 bg-red-600 text-white rounded-lg text-xs">
                        Rechazar empresa
                    </button>
                </form>
            @endif

            @if ($carpeta === 'validadas')
                {{-- Rechazar --}}
                <form method="POST" action="{{ route('admin.empresas.rechazar', $empresa->id) }}">
                    @csrf
                    <button class="px-4 py-2 bg-red-600 text-white rounded-lg text-xs">
                        Rechazar empresa
                    </button>
                </form>
            @endif

            @if ($carpeta === 'rechazadas')
                {{-- Validar --}}
                <form method="POST" action="{{ route('admin.empresas.validar', $empresa->id) }}">
                    @csrf
                    <button class="px-4 py-2 bg-green-600 text-white rounded-lg text-xs">
                        Validar empresa
                    </button>
                </form>
            @endif

        </div>

    </div>

</div>
