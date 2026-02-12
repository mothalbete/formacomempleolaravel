<form method="POST" action="{{ route('empresa.ofertas.store') }}" class="space-y-8">
    @csrf

    {{-- Selecciones principales --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- Sector --}}
        <div>
            <label class="block font-medium">Sector *</label>
            <select name="idsector" class="w-full border-gray-300 rounded-md" required>
                <option value="">Selecciona un sector</option>
                @foreach ($sectores as $sector)
                    <option value="{{ $sector->id }}" {{ old('idsector') == $sector->id ? 'selected' : '' }}>
                        {{ $sector->nombre }}
                    </option>
                @endforeach
            </select>
            @error('idsector') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Modalidad --}}
        <div>
            <label class="block font-medium">Modalidad *</label>
            <select name="idmodalidad" class="w-full border-gray-300 rounded-md" required>
                <option value="">Selecciona una modalidad</option>
                @foreach ($modalidades as $modalidad)
                    <option value="{{ $modalidad->id }}" {{ old('idmodalidad') == $modalidad->id ? 'selected' : '' }}>
                        {{ $modalidad->nombre }}
                    </option>
                @endforeach
            </select>
            @error('idmodalidad') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Puesto --}}
        <div>
            <label class="block font-medium">Puesto *</label>
            <select name="idpuesto" class="w-full border-gray-300 rounded-md" required>
                <option value="">Selecciona un puesto</option>
                @foreach ($puestos as $puesto)
                    <option value="{{ $puesto->id }}" {{ old('idpuesto') == $puesto->id ? 'selected' : '' }}>
                        {{ $puesto->nombre }}
                    </option>
                @endforeach
            </select>
            @error('idpuesto') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

    </div>

    {{-- Título --}}
    <div>
        <label class="block font-medium">Título de la oferta *</label>
        <input type="text" name="titulo" value="{{ old('titulo') }}"
               class="w-full border-gray-300 rounded-md" required>
        @error('titulo') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    {{-- Descripción --}}
    <div>
        <label class="block font-medium">Descripción *</label>
        <textarea name="descripcion" rows="5" class="w-full border-gray-300 rounded-md" required>{{ old('descripcion') }}</textarea>
        @error('descripcion') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    {{-- Requisitos --}}
    <div>
        <label class="block font-medium">Requisitos</label>
        <textarea name="requisitos" rows="4" class="w-full border-gray-300 rounded-md">{{ old('requisitos') }}</textarea>
        @error('requisitos') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    {{-- Funciones --}}
    <div>
        <label class="block font-medium">Funciones</label>
        <textarea name="funciones" rows="4" class="w-full border-gray-300 rounded-md">{{ old('funciones') }}</textarea>
        @error('funciones') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    {{-- Salario --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block font-medium">Salario mínimo</label>
            <input type="number" step="0.01" name="salario_min" value="{{ old('salario_min') }}"
                   class="w-full border-gray-300 rounded-md">
            @error('salario_min') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-medium">Salario máximo</label>
            <input type="number" step="0.01" name="salario_max" value="{{ old('salario_max') }}"
                   class="w-full border-gray-300 rounded-md">
            @error('salario_max') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>
    </div>

    {{-- Condiciones --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <label class="block font-medium">Tipo de contrato</label>
            <input type="text" name="tipo_contrato" value="{{ old('tipo_contrato') }}"
                   class="w-full border-gray-300 rounded-md">
        </div>

        <div>
            <label class="block font-medium">Jornada</label>
            <input type="text" name="jornada" value="{{ old('jornada') }}"
                   class="w-full border-gray-300 rounded-md">
        </div>

        <div>
            <label class="block font-medium">Ubicación</label>
            <input type="text" name="ubicacion" value="{{ old('ubicacion') }}"
                   class="w-full border-gray-300 rounded-md">
        </div>
    </div>

    {{-- Fechas --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block font-medium">Publicar hasta</label>
            <input type="date" name="publicar_hasta" value="{{ old('publicar_hasta') }}"
                   class="w-full border-gray-300 rounded-md">
        </div>

        <div>
            <label class="block font-medium">Fecha de incorporación</label>
            <input type="date" name="fecha_incorporacion" value="{{ old('fecha_incorporacion') }}"
                   class="w-full border-gray-300 rounded-md">
        </div>
    </div>

    {{-- Botón --}}
    <div class="pt-4">
        <button type="submit"
                class="px-6 py-3 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700 transition">
            Publicar oferta
        </button>
    </div>

</form>
