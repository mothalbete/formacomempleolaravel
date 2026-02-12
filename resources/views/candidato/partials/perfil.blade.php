@php
    $candidato = auth()->user()->candidato;
@endphp

<div x-data="{ edit: false }">

    {{-- MODO VISUALIZACIÓN --}}
    <div x-show="!edit" x-cloak class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">

        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-semibold text-gray-800">Tu perfil</h3>

            <button @click="edit = true"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-xl shadow hover:bg-indigo-700 transition text-sm">
                Editar perfil
            </button>
        </div>

        @if (!$candidato)
            <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 p-4 rounded-xl">
                <p class="text-sm">
                    Aún no has completado tu perfil.  
                    <a href="{{ route('candidato.completar-perfil') }}" class="underline font-semibold">
                        Haz clic aquí para completarlo.
                    </a>
                </p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <p class="text-sm text-gray-500">Teléfono</p>
                    <p class="font-semibold text-gray-800">{{ $candidato->telefono }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Dirección</p>
                    <p class="font-semibold text-gray-800">{{ $candidato->direccion }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Fecha de nacimiento</p>
                    <p class="font-semibold text-gray-800">
                        {{ \Carbon\Carbon::parse($candidato->fecha_nacimiento)->format('d/m/Y') }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Currículum</p>
                    <a href="{{ asset('storage/' . $candidato->cv) }}"
                       target="_blank"
                       class="text-indigo-600 font-semibold hover:underline">
                        Descargar CV
                    </a>
                </div>

                <div class="md:col-span-2">
                    <p class="text-sm text-gray-500">Experiencia profesional</p>
                    <p class="font-semibold text-gray-800 mt-1 whitespace-pre-line">
                        {{ $candidato->experiencia ?: 'No especificada' }}
                    </p>
                </div>

            </div>
        @endif

    </div>

    {{-- MODO EDICIÓN --}}
    <div x-show="edit" x-cloak class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">

        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-semibold text-gray-800">Editar perfil</h3>

            <button @click="edit = false"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-xl shadow hover:bg-gray-300 transition text-sm">
                Cancelar
            </button>
        </div>

        <form method="POST"
              action="{{ route('candidato.perfil.update') }}"
              enctype="multipart/form-data"
              class="space-y-6">

            @csrf
            @method('PUT')

            <div>
                <label class="block font-semibold text-gray-700">Teléfono *</label>
                <input type="text"
                       name="telefono"
                       value="{{ old('telefono', $candidato->telefono ?? '') }}"
                       required
                       class="mt-2 w-full border-gray-300 rounded-xl">
            </div>

            <div>
                <label class="block font-semibold text-gray-700">Dirección *</label>
                <input type="text"
                       name="direccion"
                       value="{{ old('direccion', $candidato->direccion ?? '') }}"
                       required
                       class="mt-2 w-full border-gray-300 rounded-xl">
            </div>

            <div>
                <label class="block font-semibold text-gray-700">Fecha de nacimiento *</label>
                <input type="date"
                       name="fecha_nacimiento"
                       value="{{ old('fecha_nacimiento', $candidato->fecha_nacimiento ?? '') }}"
                       required
                       class="mt-2 w-full border-gray-300 rounded-xl">
            </div>

            <div>
                <label class="block font-semibold text-gray-700">Currículum (PDF)</label>
                <input type="file"
                       name="cv"
                       accept="application/pdf"
                       class="mt-2 w-full border-gray-300 rounded-xl">
                <p class="text-xs text-gray-500 mt-1">Si subes un nuevo archivo, reemplazará al actual.</p>
            </div>

            <div>
                <label class="block font-semibold text-gray-700">Experiencia profesional</label>
                <textarea name="experiencia"
                          rows="4"
                          class="mt-2 w-full border-gray-300 rounded-xl">{{ old('experiencia', $candidato->experiencia ?? '') }}</textarea>
            </div>

            <button type="submit"
                    class="px-6 py-3 bg-indigo-600 text-white rounded-xl shadow hover:bg-indigo-700 transition">
                Guardar cambios
            </button>

        </form>

    </div>

</div>
