<x-app-layout>

<div class="max-w-4xl mx-auto py-10">

    <h1 class="text-3xl font-bold mb-6">Editar oferta</h1>

    <form method="POST" action="{{ route('empresa.ofertas.update', $oferta) }}" class="space-y-8">
        @csrf
        @method('PUT')

        {{-- Sector --}}
        <div>
            <label class="block font-medium">Sector *</label>
            <select name="idsector" class="w-full border-gray-300 rounded-md" required>
                @foreach ($sectores as $sector)
                    <option value="{{ $sector->id }}" 
                        {{ $oferta->idsector == $sector->id ? 'selected' : '' }}>
                        {{ $sector->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Modalidad --}}
        <div>
            <label class="block font-medium">Modalidad *</label>
            <select name="idmodalidad" class="w-full border-gray-300 rounded-md" required>
                @foreach ($modalidades as $modalidad)
                    <option value="{{ $modalidad->id }}" 
                        {{ $oferta->idmodalidad == $modalidad->id ? 'selected' : '' }}>
                        {{ $modalidad->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Puesto --}}
        <div>
            <label class="block font-medium">Puesto *</label>
            <select name="idpuesto" class="w-full border-gray-300 rounded-md" required>
                @foreach ($puestos as $puesto)
                    <option value="{{ $puesto->id }}" 
                        {{ $oferta->idpuesto == $puesto->id ? 'selected' : '' }}>
                        {{ $puesto->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Título --}}
        <div>
            <label class="block font-medium">Título *</label>
            <input type="text" name="titulo" value="{{ old('titulo', $oferta->titulo) }}"
                   class="w-full border-gray-300 rounded-md" required>
        </div>

        {{-- Descripción --}}
        <div>
            <label class="block font-medium">Descripción *</label>
            <textarea name="descripcion" rows="5" class="w-full border-gray-300 rounded-md" required>
                {{ old('descripcion', $oferta->descripcion) }}
            </textarea>
        </div>

        {{-- Resto de campos igual que en form-crear... --}}
        {{-- ... --}}

        <button type="submit"
                class="px-6 py-3 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700 transition">
            Guardar cambios
        </button>

    </form>

</div>

</x-app-layout>
