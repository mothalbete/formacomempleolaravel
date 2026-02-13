<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8"
     x-data="{ tab: 'pendientes' }">

    <h3 class="text-2xl font-bold text-gray-900 mb-8">Mis candidaturas</h3>

    {{-- Si no hay ninguna candidatura --}}
    @if ($misCandidaturas->isEmpty())
        <p class="text-gray-600">Todavía no te has inscrito en ninguna oferta.</p>
    @else

        {{-- BOTONES DE CARPETAS --}}
        <div class="flex gap-4 mb-8">

            {{-- Pendientes --}}
            <button 
                @click="tab = 'pendientes'"
                :class="tab === 'pendientes' 
                    ? 'bg-indigo-600 text-white' 
                    : 'bg-gray-200 text-gray-700'"
                class="px-4 py-2 rounded-lg font-medium flex items-center gap-2"
            >
                Pendientes
                <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-white text-indigo-700">
                    {{ $pendientes->count() }}
                </span>
            </button>

            {{-- Aceptadas --}}
            <button 
                @click="tab = 'aceptadas'"
                :class="tab === 'aceptadas' 
                    ? 'bg-indigo-600 text-white' 
                    : 'bg-gray-200 text-gray-700'"
                class="px-4 py-2 rounded-lg font-medium flex items-center gap-2"
            >
                Aceptadas
                <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-white text-indigo-700">
                    {{ $aceptadas->count() }}
                </span>
            </button>

            {{-- Rechazadas --}}
            <button 
                @click="tab = 'rechazadas'"
                :class="tab === 'rechazadas' 
                    ? 'bg-indigo-600 text-white' 
                    : 'bg-gray-200 text-gray-700'"
                class="px-4 py-2 rounded-lg font-medium flex items-center gap-2"
            >
                Rechazadas
                <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-white text-indigo-700">
                    {{ $rechazadas->count() }}
                </span>
            </button>

        </div>

        {{-- LISTA DE PENDIENTES --}}
        <div x-show="tab === 'pendientes'" class="space-y-5">
            @foreach ($pendientes as $oferta)
                @include('candidato.partials.candidatura-acordeon', ['oferta' => $oferta])
            @endforeach

            @if ($pendientes->isEmpty())
                <p class="text-gray-500 italic">No tienes candidaturas pendientes.</p>
            @endif
        </div>

        {{-- LISTA DE ACEPTADAS --}}
        <div x-show="tab === 'aceptadas'" class="space-y-5">
            @foreach ($aceptadas as $oferta)
                @include('candidato.partials.candidatura-acordeon', ['oferta' => $oferta])
            @endforeach

            @if ($aceptadas->isEmpty())
                <p class="text-gray-500 italic">No tienes candidaturas aceptadas.</p>
            @endif
        </div>

        {{-- LISTA DE RECHAZADAS --}}
        <div x-show="tab === 'rechazadas'" class="space-y-5">
            @foreach ($rechazadas as $oferta)
                @include('candidato.partials.candidatura-acordeon', ['oferta' => $oferta])
            @endforeach

            @if ($rechazadas->isEmpty())
                <p class="text-gray-500 italic">No tienes candidaturas rechazadas.</p>
            @endif
        </div>

    @endif

</div>
