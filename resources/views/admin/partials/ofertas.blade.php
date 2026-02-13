<div x-data="{ carpeta: '{{ $carpeta ?? 'pendientes' }}' }">

    {{-- BUSCADOR + FILTRO DE FECHAS --}}
    <form method="GET" class="flex flex-wrap gap-4 mb-8 items-end">

        {{-- Buscador --}}
        <div class="flex flex-col">
            <label class="text-sm text-gray-600 mb-1">Buscar oferta</label>
            <input type="text" name="search" value="{{ $search }}"
                   placeholder="Título, empresa..."
                   class="border rounded-lg px-3 py-2 w-64">
        </div>

        {{-- Filtro de fechas dinámicas --}}
        <div class="flex flex-col">
            <label class="text-sm text-gray-600 mb-1">Filtrar por fecha</label>

            <select name="fecha" class="border rounded-lg px-3 py-2 w-48">

                <option value="">Todas las fechas</option>

                {{-- Fechas según carpeta activa --}}
                <template x-if="carpeta === 'pendientes'">
                    <optgroup label="Fechas de creación">
                        @foreach ($fechasOfertasPendientes as $f)
                            <option value="{{ $f }}" @selected($fecha == $f)>
                                {{ $f }}
                            </option>
                        @endforeach
                    </optgroup>
                </template>

                <template x-if="carpeta === 'aprobadas'">
                    <optgroup label="Fechas de publicación">
                        @foreach ($fechasOfertasAprobadas as $f)
                            <option value="{{ $f }}" @selected($fecha == $f)>
                                {{ $f }}
                            </option>
                        @endforeach
                    </optgroup>
                </template>

                <template x-if="carpeta === 'rechazadas'">
                    <optgroup label="Fechas de rechazo">
                        @foreach ($fechasOfertasRechazadas as $f)
                            <option value="{{ $f }}" @selected($fecha == $f)>
                                {{ $f }}
                            </option>
                        @endforeach
                    </optgroup>
                </template>

            </select>
        </div>

        {{-- Botón filtrar --}}
        <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg">
            Filtrar
        </button>

        {{-- Mantener la carpeta activa --}}
        <input type="hidden" name="carpeta" x-model="carpeta">

    </form>

    {{-- CARPETAS --}}
    <div class="flex gap-4 mb-8">

        {{-- Pendientes --}}
        <button 
            @click="carpeta = 'pendientes'"
            class="px-4 py-2 rounded-lg font-medium"
            :class="carpeta === 'pendientes' 
                ? 'bg-indigo-600 text-white' 
                : 'bg-gray-200 text-gray-700'"
        >
            Pendientes ({{ $ofertasPendientes->count() }})
        </button>

        {{-- Aprobadas --}}
        <button 
            @click="carpeta = 'aprobadas'"
            class="px-4 py-2 rounded-lg font-medium"
            :class="carpeta === 'aprobadas' 
                ? 'bg-indigo-600 text-white' 
                : 'bg-gray-200 text-gray-700'"
        >
            Aprobadas ({{ $ofertasAprobadas->count() }})
        </button>

        {{-- Rechazadas --}}
        <button 
            @click="carpeta = 'rechazadas'"
            class="px-4 py-2 rounded-lg font-medium"
            :class="carpeta === 'rechazadas' 
                ? 'bg-indigo-600 text-white' 
                : 'bg-gray-200 text-gray-700'"
        >
            Rechazadas ({{ $ofertasRechazadas->count() }})
        </button>

    </div>

    {{-- LISTA DE OFERTAS POR CARPETA --}}
    <div class="space-y-6">

        {{-- PENDIENTES --}}
        <div x-show="carpeta === 'pendientes'" class="space-y-6">
            @forelse ($ofertasPendientes as $oferta)
                @include('admin.partials.oferta-acordeon', ['oferta' => $oferta, 'carpeta' => 'pendientes'])
            @empty
                <p class="text-gray-500 italic">No hay ofertas pendientes.</p>
            @endforelse
        </div>

        {{-- APROBADAS --}}
        <div x-show="carpeta === 'aprobadas'" class="space-y-6">
            @forelse ($ofertasAprobadas as $oferta)
                @include('admin.partials.oferta-acordeon', ['oferta' => $oferta, 'carpeta' => 'aprobadas'])
            @empty
                <p class="text-gray-500 italic">No hay ofertas aprobadas.</p>
            @endforelse
        </div>

        {{-- RECHAZADAS --}}
        <div x-show="carpeta === 'rechazadas'" class="space-y-6">
            @forelse ($ofertasRechazadas as $oferta)
                @include('admin.partials.oferta-acordeon', ['oferta' => $oferta, 'carpeta' => 'rechazadas'])
            @empty
                <p class="text-gray-500 italic">No hay ofertas rechazadas.</p>
            @endforelse
        </div>

    </div>

</div>
