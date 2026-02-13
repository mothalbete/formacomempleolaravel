{{-- Empresa --}}
<div class="mb-3">
    <p class="text-xs text-gray-500">Empresa</p>
    <p class="font-medium text-gray-800">
        {{ $oferta->empresa->nombre }}
    </p>
</div>

{{-- Salario --}}
<div class="mb-3">
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

{{-- Botón retirarse --}}
<form method="POST" action="{{ route('candidato.retirarse', $oferta->id) }}" class="mt-4">
    @csrf
    @method('DELETE')
    <button
        class="px-4 py-2 bg-red-600 text-white rounded-xl shadow hover:bg-red-700 transition text-xs">
        Retirarme
    </button>
</form>
