<div class="p-4 border rounded-lg bg-gray-50">

    {{-- Cabecera con logo y nombre --}}
    <div class="flex items-center gap-4 mb-4">

        {{-- Logo --}}
        @if ($empresa->logo)
            <img src="{{ asset('storage/' . $empresa->logo) }}" 
                 alt="Logo empresa" 
                 class="w-16 h-16 rounded-lg object-cover border">
        @else
            <div class="w-16 h-16 rounded-lg bg-gray-300 flex items-center justify-center text-gray-600">
                Sin logo
            </div>
        @endif

        <div>
            <p class="text-xs text-gray-500">Empresa</p>
            <p class="font-semibold text-gray-900 text-lg">
                {{ $empresa->nombre }}
            </p>

            @if ($empresa->verificada)
                <span class="text-green-600 text-xs font-semibold">✔ Empresa verificada</span>
            @endif
        </div>

    </div>

    {{-- Datos principales --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">

        <div>
            <p class="text-gray-500 text-xs">Ciudad</p>
            <p class="font-medium text-gray-800">{{ $empresa->ciudad ?? 'No especificada' }}</p>
        </div>

        <div>
            <p class="text-gray-500 text-xs">Provincia</p>
            <p class="font-medium text-gray-800">{{ $empresa->provincia ?? 'No especificada' }}</p>
        </div>

        <div>
            <p class="text-gray-500 text-xs">Dirección</p>
            <p class="font-medium text-gray-800">
                {{ $empresa->direccion ?? 'No especificada' }}
                @if ($empresa->cp)
                    ({{ $empresa->cp }})
                @endif
            </p>
        </div>

        <div>
            <p class="text-gray-500 text-xs">Teléfono</p>
            <p class="font-medium text-gray-800">{{ $empresa->telefono ?? 'No especificado' }}</p>
        </div>

        <div>
            <p class="text-gray-500 text-xs">Email de contacto</p>
            <p class="font-medium text-gray-800">{{ $empresa->email_contacto ?? 'No especificado' }}</p>
        </div>

        <div>
            <p class="text-gray-500 text-xs">Persona de contacto</p>
            <p class="font-medium text-gray-800">{{ $empresa->persona_contacto ?? 'No especificada' }}</p>
        </div>

        <div>
            <p class="text-gray-500 text-xs">Web</p>
            @if ($empresa->web)
                <a href="{{ $empresa->web }}" target="_blank" 
                   class="text-indigo-600 hover:text-indigo-800 font-medium">
                    {{ $empresa->web }}
                </a>
            @else
                <p class="font-medium text-gray-800">No especificada</p>
            @endif
        </div>

    </div>

</div>
