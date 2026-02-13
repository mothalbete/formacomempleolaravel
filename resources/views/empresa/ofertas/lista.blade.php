@if ($ofertas->isEmpty())
    <p class="text-gray-600">Todavía no has publicado ninguna oferta.</p>
@else
    <div class="space-y-6">

        @foreach ($ofertas as $oferta)
            <div class="p-6 border border-gray-200 rounded-xl shadow-sm bg-white">

                {{-- CABECERA --}}
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

                        {{-- SALARIO --}}
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

                    {{-- ESTADO --}}
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

                {{-- FOOTER --}}
                <div class="mt-4 flex justify-between items-center text-sm text-gray-500">
                    <span>Publicada el {{ $oferta->created_at->format('d/m/Y') }}</span>

                    <div class="flex gap-4">
                        <a href="{{ route('empresa.ofertas.edit', $oferta) }}"
                            class="text-indigo-600 hover:text-indigo-800 font-medium">
                            Editar
                        </a>

                        {{-- Botón ver postulaciones --}}
                        <button 
                            @click="open === {{ $oferta->id }} 
                                ? open = null 
                                : (open = {{ $oferta->id }}, loadPostulaciones({{ $oferta->id }}))"
                            class="text-indigo-600 hover:text-indigo-800 font-medium">
                            Ver postulaciones
                        </button>
                    </div>
                </div>

                {{-- ACORDEÓN --}}
                <div 
                    x-show="open === {{ $oferta->id }}" 
                    x-transition 
                    x-data="{ postulacionesTab: 'pendientes' }"
                    class="mt-4 border-t pt-4"
                >

                    {{-- BOTONES DE CARPETAS --}}
                    <div class="flex gap-4 mb-4">

                        {{-- Pendientes --}}
                        <button 
                            @click="postulacionesTab = 'pendientes'" 
                            :class="postulacionesTab === 'pendientes' 
                                ? 'bg-indigo-600 text-white' 
                                : 'bg-gray-200 text-gray-700'"
                            class="px-4 py-2 rounded-lg font-medium flex items-center gap-2"
                        >
                            Pendientes
                            <span 
                                class="px-2 py-0.5 rounded-full text-xs font-semibold"
                                :class="postulaciones[{{ $oferta->id }}].pendientes.length > 0 
                                    ? 'bg-white text-indigo-700' 
                                    : 'bg-gray-300 text-gray-700'"
                                x-text="postulaciones[{{ $oferta->id }}].pendientes.length"
                            ></span>
                        </button>

                        {{-- Aceptados --}}
                        <button 
                            @click="postulacionesTab = 'aceptados'" 
                            :class="postulacionesTab === 'aceptados' 
                                ? 'bg-indigo-600 text-white' 
                                : 'bg-gray-200 text-gray-700'"
                            class="px-4 py-2 rounded-lg font-medium flex items-center gap-2"
                        >
                            Aceptados
                            <span 
                                class="px-2 py-0.5 rounded-full text-xs font-semibold"
                                :class="postulaciones[{{ $oferta->id }}].aceptados.length > 0 
                                    ? 'bg-white text-indigo-700' 
                                    : 'bg-gray-300 text-gray-700'"
                                x-text="postulaciones[{{ $oferta->id }}].aceptados.length"
                            ></span>
                        </button>

                        {{-- Rechazados --}}
                        <button 
                            @click="postulacionesTab = 'rechazados'" 
                            :class="postulacionesTab === 'rechazados' 
                                ? 'bg-indigo-600 text-white' 
                                : 'bg-gray-200 text-gray-700'"
                            class="px-4 py-2 rounded-lg font-medium flex items-center gap-2"
                        >
                            Rechazados
                            <span 
                                class="px-2 py-0.5 rounded-full text-xs font-semibold"
                                :class="postulaciones[{{ $oferta->id }}].rechazados.length > 0 
                                    ? 'bg-white text-indigo-700' 
                                    : 'bg-gray-300 text-gray-700'"
                                x-text="postulaciones[{{ $oferta->id }}].rechazados.length"
                            ></span>
                        </button>

                    </div>

                    {{-- LISTA DE PENDIENTES --}}
                    <template x-if="postulacionesTab === 'pendientes'">
                        <div>
                            <template x-for="post in postulaciones[{{ $oferta->id }}].pendientes" :key="post.id">
                                <div class="p-4 border rounded-lg bg-gray-50 flex justify-between items-center mb-3">

                                    <div>
                                        <p class="font-semibold text-gray-800" x-text="post.user.name"></p>
                                        <p class="text-gray-600 text-sm" x-text="post.user.email"></p>
                                    </div>

                                    <div class="flex items-center gap-4">

                                        <button 
                                            @click="openCv(post.cv_url)"
                                            class="text-indigo-600 hover:text-indigo-800 font-medium">
                                            Ver CV
                                        </button>

                                        <button 
                                            @click="aceptarCandidato({{ $oferta->id }}, post.id)"
                                            class="text-green-600 hover:text-green-800 font-medium">
                                            Aceptar
                                        </button>

                                        <button 
                                            @click="rechazarCandidato({{ $oferta->id }}, post.id)"
                                            class="text-red-600 hover:text-red-800 font-medium">
                                            Rechazar
                                        </button>

                                    </div>

                                </div>
                            </template>

                            <p x-if="postulaciones[{{ $oferta->id }}].pendientes.length === 0" class="text-gray-500 italic">
                                No hay postulaciones pendientes.
                            </p>
                        </div>
                    </template>

                    {{-- LISTA DE ACEPTADOS --}}
                    <template x-if="postulacionesTab === 'aceptados'">
                        <div>
                            <template x-for="post in postulaciones[{{ $oferta->id }}].aceptados" :key="post.id">
                                <div class="p-4 border rounded-lg bg-green-50 flex justify-between items-center mb-3">

                                    <div>
                                        <p class="font-semibold text-gray-800" x-text="post.user.name"></p>
                                        <p class="text-gray-600 text-sm" x-text="post.user.email"></p>
                                    </div>

                                    <span class="text-green-700 font-medium">Aceptado</span>

                                </div>
                            </template>

                            <p x-if="postulaciones[{{ $oferta->id }}].aceptados.length === 0" class="text-gray-500 italic">
                                No hay postulaciones aceptadas.
                            </p>
                        </div>
                    </template>

                    {{-- LISTA DE RECHAZADOS --}}
                    <template x-if="postulacionesTab === 'rechazados'">
                        <div>
                            <template x-for="post in postulaciones[{{ $oferta->id }}].rechazados" :key="post.id">
                                <div class="p-4 border rounded-lg bg-red-50 flex justify-between items-center mb-3">

                                    <div>
                                        <p class="font-semibold text-gray-800" x-text="post.user.name"></p>
                                        <p class="text-gray-600 text-sm" x-text="post.user.email"></p>
                                    </div>

                                    <span class="text-red-700 font-medium">Rechazado</span>

                                </div>
                            </template>

                            <p x-if="postulaciones[{{ $oferta->id }}].rechazados.length === 0" class="text-gray-500 italic">
                                No hay postulaciones rechazadas.
                            </p>
                        </div>
                    </template>

                </div>

            </div>
        @endforeach

    </div>
@endif
