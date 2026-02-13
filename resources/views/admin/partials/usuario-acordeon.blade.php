<div x-data="{ open: false }" 
     class="border border-gray-300 rounded-xl overflow-hidden bg-gray-50 shadow-sm">

    {{-- CABECERA --}}
    <button @click="open = !open"
        class="w-full flex justify-between items-center p-4 bg-gray-100 hover:bg-gray-200 transition">

        <div class="text-left">
            <h4 class="text-lg font-semibold text-gray-900">
                {{ $user->name }}
            </h4>

            <p class="text-gray-600 text-xs mt-1">
                {{ $user->email }}
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

        {{-- Información del usuario --}}
        <div class="mb-4">
            <p class="text-xs text-gray-500">Nombre</p>
            <p class="font-medium text-gray-800">{{ $user->name }}</p>
        </div>

        <div class="mb-4">
            <p class="text-xs text-gray-500">Email</p>
            <p class="font-medium text-gray-800">{{ $user->email }}</p>
        </div>

        <div class="mb-4">
            <p class="text-xs text-gray-500">Fecha de registro</p>
            <p class="font-medium text-gray-800">{{ $user->created_at->format('d/m/Y') }}</p>
        </div>

        {{-- Si es empresa, mostramos info de empresa --}}
        @if ($carpeta === 'empresas' && $user->empresa)
            <div class="mt-6">
                <h3 class="text-sm font-semibold text-gray-700 mb-2">Empresa asociada</h3>
                <x-empresa-info :empresa="$user->empresa" />
            </div>
        @endif

        {{-- Acciones futuras --}}
        <div class="mt-6 text-xs text-gray-500 italic">
            (Aquí podrás añadir acciones como desactivar, borrar, resetear contraseña…)
        </div>

    </div>

</div>
