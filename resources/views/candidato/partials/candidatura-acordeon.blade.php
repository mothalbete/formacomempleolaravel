<div x-data="{ open: false }" class="border border-gray-300 rounded-xl overflow-hidden bg-gray-50 shadow-sm">

    {{-- CABECERA --}}
    <button @click="open = !open"
        class="w-full flex justify-between items-center p-4 bg-gray-100 hover:bg-gray-200 transition">

        <div class="text-left">
            <h4 class="text-lg font-semibold text-gray-900">
                {{ $oferta->titulo }}
            </h4>

            <p class="text-gray-600 text-xs mt-1">
                {{ $oferta->puesto->nombre ?? 'Puesto no especificado' }} ·
                {{ $oferta->ubicacion }}
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

        {{-- INFORMACIÓN DE LA EMPRESA --}}
        <x-empresa-info :empresa="$oferta->empresa" />

        {{-- Salario --}}
        <div class="mb-3 mt-6">
            <p class="text-xs text-gray-500">Salario</p>
            <p class="font-medium text-gray-800">
                @if ($oferta->salario_min && $oferta->salario_max)
                    {{ $oferta->salario_min }}€ - {{ $oferta->salario_max }}€
                @else
                    A convenir
                @endif
            </p>
        </div>

        {{-- Descripción --}}
        <div class="mb-3">
            <p class="text-xs text-gray-500">Descripción</p>
            <p class="text-gray-800 whitespace-pre-line">
                {{ $oferta->descripcion }}
            </p>
        </div>

        {{-- Botón retirarse (solo si no está rechazada) --}}
        @if ($oferta->estado !== 'rechazado')
            <form method="POST" action="{{ route('candidato.retirarse', $oferta->id) }}" class="mt-4">
                @csrf
                @method('DELETE')
                <button class="px-4 py-2 bg-red-600 text-white rounded-xl shadow hover:bg-red-700 transition text-xs">
                    Retirarme
                </button>
            </form>
        @endif


    </div>

</div>