<x-app-layout>

    <div class="max-w-3xl mx-auto py-14 px-6 md:px-10">

        {{-- Título --}}
        <h1 class="text-3xl font-bold text-gray-900 mb-4">
            Completa tu perfil de candidato
        </h1>

        <p class="text-gray-600 mb-8">
            Necesitamos algunos datos adicionales para activar tu cuenta de candidato.
        </p>

        {{-- Errores de validación --}}
        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST"
              action="{{ route('candidato.completar-perfil.store') }}"
              enctype="multipart/form-data"
              class="space-y-8 bg-white border border-gray-200 rounded-2xl shadow-sm p-8">

            @csrf

            {{-- Teléfono --}}
            <div>
                <label class="block font-semibold text-gray-800">Teléfono *</label>
                <input type="text"
                       name="telefono"
                       value="{{ old('telefono') }}"
                       required
                       class="mt-2 w-full border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- Dirección --}}
            <div>
                <label class="block font-semibold text-gray-800">Dirección *</label>
                <input type="text"
                       name="direccion"
                       value="{{ old('direccion') }}"
                       required
                       class="mt-2 w-full border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- Fecha de nacimiento --}}
            <div>
                <label class="block font-semibold text-gray-800">Fecha de nacimiento *</label>
                <input type="date"
                       name="fecha_nacimiento"
                       value="{{ old('fecha_nacimiento') }}"
                       required
                       class="mt-2 w-full border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- CV --}}
            <div>
                <label class="block font-semibold text-gray-800">Currículum (PDF) *</label>
                <input type="file"
                       name="cv"
                       accept="application/pdf"
                       required
                       class="mt-2 w-full border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- Experiencia --}}
            <div>
                <label class="block font-semibold text-gray-800">Experiencia profesional</label>
                <textarea name="experiencia"
                          rows="4"
                          class="mt-2 w-full border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500">{{ old('experiencia') }}</textarea>
            </div>

            {{-- Botón --}}
            <div class="pt-4">
                <button type="submit"
                        class="px-6 py-3 bg-indigo-600 text-white rounded-xl shadow hover:bg-indigo-700 transition font-semibold">
                    Guardar y continuar
                </button>
            </div>

        </form>

    </div>

</x-app-layout>
