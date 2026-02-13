<div x-data="{ carpeta: '{{ $carpeta ?? 'candidatos' }}' }">

    {{-- BUSCADOR + FILTRO DE FECHAS --}}
    <form method="GET" class="flex flex-wrap gap-4 mb-8 items-end">

        {{-- Buscador --}}
        <div class="flex flex-col">
            <label class="text-sm text-gray-600 mb-1">Buscar usuario</label>
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
                <template x-if="carpeta === 'candidatos'">
                    <optgroup label="Fechas de registro">
                        @foreach ($fechasCandidatos as $f)
                            <option value="{{ $f }}" @selected($fecha == $f)>
                                {{ $f }}
                            </option>
                        @endforeach
                    </optgroup>
                </template>

                <template x-if="carpeta === 'empresas'">
                    <optgroup label="Fechas de registro">
                        @foreach ($fechasUsuariosEmpresa as $f)
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

        {{-- Candidatos --}}
        <button 
            @click="carpeta = 'candidatos'"
            class="px-4 py-2 rounded-lg font-medium"
            :class="carpeta === 'candidatos' 
                ? 'bg-indigo-600 text-white' 
                : 'bg-gray-200 text-gray-700'"
        >
            Candidatos ({{ $candidatos->count() }})
        </button>

        {{-- Empresas --}}
        <button 
            @click="carpeta = 'empresas'"
            class="px-4 py-2 rounded-lg font-medium"
            :class="carpeta === 'empresas' 
                ? 'bg-indigo-600 text-white' 
                : 'bg-gray-200 text-gray-700'"
        >
            Empresas ({{ $empresasUsuarios->count() }})
        </button>

    </div>

    {{-- LISTA DE USUARIOS POR CARPETA --}}
    <div class="space-y-6">

        {{-- CANDIDATOS --}}
        <div x-show="carpeta === 'candidatos'" class="space-y-6">
            @forelse ($candidatos as $user)
                @include('admin.partials.usuario-acordeon', ['user' => $user, 'carpeta' => 'candidatos'])
            @empty
                <p class="text-gray-500 italic">No hay candidatos registrados.</p>
            @endforelse
        </div>

        {{-- EMPRESAS --}}
        <div x-show="carpeta === 'empresas'" class="space-y-6">
            @forelse ($empresasUsuarios as $user)
                @include('admin.partials.usuario-acordeon', ['user' => $user, 'carpeta' => 'empresas'])
            @empty
                <p class="text-gray-500 italic">No hay empresas registradas.</p>
            @endforelse
        </div>

    </div>

</div>
