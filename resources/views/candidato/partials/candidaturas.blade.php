<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">

    <h3 class="text-2xl font-bold text-gray-900 mb-8">Mis candidaturas</h3>

    @if ($candidaturas->isEmpty())
        <p class="text-gray-600">Todavía no te has inscrito en ninguna oferta.</p>
    @else
        <div class="space-y-5">

            @foreach ($candidaturas as $oferta)
                <div x-data="{ open: false }" class="border border-gray-300 rounded-xl overflow-hidden bg-gray-50 shadow-sm">

                    {{-- CABECERA DEL ACORDEÓN --}}
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

                        {{-- ICONOS DEFINITIVOS (no se inflan nunca) --}}
                        <svg x-show="!open" style="width:16px;height:16px;flex-shrink:0;flex-grow:0;flex-basis:auto;"
                            class="text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>

                        <svg x-show="open" style="width:16px;height:16px;flex-shrink:0;flex-grow:0;flex-basis:auto;"
                            class="text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4" />
                        </svg>
                    </button>

                    {{-- CONTENIDO --}}
                    <div x-show="open" x-collapse class="p-5 bg-white text-sm">

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

                        {{-- Tipo de contrato --}}
                        <div class="mb-3">
                            <p class="text-xs text-gray-500">Tipo de contrato</p>
                            <p class="font-medium text-gray-800">
                                {{ $oferta->tipo_contrato ?? 'No especificado' }}
                            </p>
                        </div>

                        {{-- Jornada --}}
                        <div class="mb-3">
                            <p class="text-xs text-gray-500">Jornada</p>
                            <p class="font-medium text-gray-800">
                                {{ $oferta->jornada ?? 'No especificada' }}
                            </p>
                        </div>

                        {{-- Descripción --}}
                        <div class="mb-3">
                            <p class="text-xs text-gray-500">Descripción</p>
                            <p class="text-gray-800 whitespace-pre-line">
                                {{ $oferta->descripcion }}
                            </p>
                        </div>

                        {{-- Requisitos --}}
                        @if ($oferta->requisitos)
                            <div class="mb-3">
                                <p class="text-xs text-gray-500">Requisitos</p>
                                <p class="text-gray-800 whitespace-pre-line">
                                    {{ $oferta->requisitos }}
                                </p>
                            </div>
                        @endif

                        {{-- Funciones --}}
                        @if ($oferta->funciones)
                            <div class="mb-3">
                                <p class="text-xs text-gray-500">Funciones</p>
                                <p class="text-gray-800 whitespace-pre-line">
                                    {{ $oferta->funciones }}
                                </p>
                            </div>
                        @endif

                        {{-- Fecha de incorporación --}}
                        @if ($oferta->fecha_incorporacion)
                            <div class="mb-3">
                                <p class="text-xs text-gray-500">Fecha de incorporación</p>
                                <p class="font-medium text-gray-800">
                                    {{ $oferta->fecha_incorporacion->format('d/m/Y') }}
                                </p>
                            </div>
                        @endif

                        {{-- Botón retirarse --}}
                        <form method="POST" action="{{ route('candidato.retirarse', $oferta->id) }}" class="mt-4">
                            @csrf
                            @method('DELETE')
                            <button
                                class="px-4 py-2 bg-red-600 text-white rounded-xl shadow hover:bg-red-700 transition text-xs">
                                Retirarme
                            </button>
                        </form>


                    </div>

                </div>
            @endforeach

        </div>
    @endif

</div>