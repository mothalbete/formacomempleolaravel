@if ($ofertas->isEmpty())
    <p class="text-gray-600">Todavía no has publicado ninguna oferta.</p>
@else
    <div class="space-y-6">

        @foreach ($ofertas as $oferta)
            <div class="p-6 border border-gray-200 rounded-xl shadow-sm bg-white">

                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900">
                            {{ $oferta->titulo }}
                        </h3>

                        <p class="text-gray-600 mt-1">
                            {{ Str::limit($oferta->descripcion, 120) }}
                        </p>

                        <div class="mt-3 flex flex-wrap items-center gap-4 text-sm text-gray-500">
                            <span><strong>Sector:</strong> {{ $oferta->sector->nombre }}</span>
                            <span><strong>Puesto:</strong> {{ $oferta->puesto->nombre }}</span>
                            <span><strong>Modalidad:</strong> {{ $oferta->modalidad->nombre }}</span>
                        </div>

                        {{-- 💰 Salario --}}
                        <div class="mt-3 text-sm text-gray-700">
                            @if ($oferta->salario_min && $oferta->salario_max)
                                <span class="font-semibold">Salario:</span>
                                {{ number_format($oferta->salario_min, 0, ',', '.') }}€ –
                                {{ number_format($oferta->salario_max, 0, ',', '.') }}€
                            @elseif ($oferta->salario_min)
                                <span class="font-semibold">Salario desde:</span>
                                {{ number_format($oferta->salario_min, 0, ',', '.') }}€
                            @elseif ($oferta->salario_max)
                                <span class="font-semibold">Salario hasta:</span>
                                {{ number_format($oferta->salario_max, 0, ',', '.') }}€
                            @else
                                <span class="text-gray-500 italic">Salario no especificado</span>
                            @endif
                        </div>
                    </div>

                    {{-- Estado --}}
                    <span class="
                        px-3 py-1 rounded-full text-sm font-medium
                        @if($oferta->estado === 'publicada') bg-green-100 text-green-700
                        @elseif($oferta->estado === 'pausada') bg-yellow-100 text-yellow-700
                        @elseif($oferta->estado === 'cerrada') bg-red-100 text-red-700
                        @else bg-gray-100 text-gray-700
                        @endif
                    ">
                        {{ ucfirst($oferta->estado) }}
                    </span>
                </div>

                {{-- Footer --}}
                <div class="mt-4 flex justify-between items-center text-sm text-gray-500">
                    <span>Publicada el {{ $oferta->created_at->format('d/m/Y') }}</span>

                    <a href="{{ route('empresa.ofertas.edit', $oferta) }}"
                       class="text-indigo-600 hover:text-indigo-800 font-medium">
                        Editar
                    </a>
                </div>

            </div>
        @endforeach

    </div>
@endif
