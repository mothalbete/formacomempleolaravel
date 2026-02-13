<div x-data="{ carpeta: '{{ $carpeta ?? 'pendientes' }}' }">

    {{-- BUSCADOR + FILTRO DE FECHAS --}}
    <form method="GET" class="flex flex-wrap gap-4 mb-8 items-end">

        {{-- Buscador --}}
        <div class="flex flex-col">
            <label class="text-sm text-gray-600 mb-1">Buscar empresa</label>
            <input type="text" name="search" value="{{ $search }}"
                   placeholder="Nombre, email..."
                   class="border rounded-lg px-3 py-2 w-64">
        </div>

        {{-- Filtro de fechas dinámicas --}}
        <div class="flex flex-col">
            <label class="text-sm text-gray-600 mb-1">Filtrar por fecha</label>

            <select name="fecha" class="border rounded-lg px-3 py-2 w-48">

                <option value="">Todas las fechas</option>

                {{-- Fechas según carpeta activa --}}
                <template x-if="carpeta === 'pendientes'">
                    <optgroup label="Fechas de registro">
                        @foreach ($fechasEmpresasPendientes as $f)
                            <option value="{{ $f }}" @selected($fecha == $f)>
                                {{ $f }}
                            </option>
                        @endforeach
                    </optgroup>
                </template>

                <template x-if="carpeta === 'validadas'">
                    <optgroup label="Fechas de validación">
                        @foreach ($fechasEmpresasValidadas as $f)
                            <option value="{{ $f }}" @selected($fecha == $f)>
                                {{ $f }}
                            </option>
                        @endforeach
                    </optgroup>
                </template>

                <template x-if="carpeta === 'rechazadas'">
                    <optgroup label="Fechas de rechazo">
                        @foreach ($fechasEmpresasRechazadas as $f)
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
            Pendientes ({{ $empresasPendientes->count() }})
        </button>

        {{-- Validadas --}}
        <button 
            @click="carpeta = 'validadas'"
            class="px-4 py-2 rounded-lg font-medium"
            :class="carpeta === 'validadas' 
                ? 'bg-indigo-600 text-white' 
                : 'bg-gray-200 text-gray-700'"
        >
            Validadas ({{ $empresasValidadas->count() }})
        </button>

        {{-- Rechazadas --}}
        <button 
            @click="carpeta = 'rechazadas'"
            class="px-4 py-2 rounded-lg font-medium"
            :class="carpeta === 'rechazadas' 
                ? 'bg-indigo-600 text-white' 
                : 'bg-gray-200 text-gray-700'"
        >
            Rechazadas ({{ $empresasRechazadas->count() }})
        </button>

    </div>

    {{-- LISTA DE EMPRESAS POR CARPETA --}}
    <div class="space-y-6">

        {{-- PENDIENTES --}}
        <div x-show="carpeta === 'pendientes'" class="space-y-6">
            @forelse ($empresasPendientes as $empresa)
                @include('admin.partials.empresa-acordeon', ['empresa' => $empresa, 'carpeta' => 'pendientes'])
            @empty
                <p class="text-gray-500 italic">No hay empresas pendientes.</p>
            @endforelse
        </div>

        {{-- VALIDADAS --}}
        <div x-show="carpeta === 'validadas'" class="space-y-6">
            @forelse ($empresasValidadas as $empresa)
                @include('admin.partials.empresa-acordeon', ['empresa' => $empresa, 'carpeta' => 'validadas'])
            @empty
                <p class="text-gray-500 italic">No hay empresas validadas.</p>
            @endforelse
        </div>

        {{-- RECHAZADAS --}}
        <div x-show="carpeta === 'rechazadas'" class="space-y-6">
            @forelse ($empresasRechazadas as $empresa)
                @include('admin.partials.empresa-acordeon', ['empresa' => $empresa, 'carpeta' => 'rechazadas'])
            @empty
                <p class="text-gray-500 italic">No hay empresas rechazadas.</p>
            @endforelse
        </div>

    </div>

</div>
