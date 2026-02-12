<div class="max-w-4xl mx-auto">

    <h1 class="text-3xl font-bold mb-6 text-center">
        Completa tu perfil de candidato
    </h1>

    <p class="text-gray-600 text-center mb-10">
        Necesitamos algunos datos adicionales para activar tu cuenta.
    </p>

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

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <div>
                <label class="block font-semibold text-gray-800">Teléfono *</label>
                <input type="text" name="telefono" value="{{ old('telefono') }}" required
                       class="mt-2 w-full border-gray-300 rounded-xl">
            </div>

            <div>
                <label class="block font-semibold text-gray-800">Fecha de nacimiento *</label>
                <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required
                       class="mt-2 w-full border-gray-300 rounded-xl">
            </div>

            <div class="md:col-span-2">
                <label class="block font-semibold text-gray-800">Dirección *</label>
                <input type="text" name="direccion" value="{{ old('direccion') }}" required
                       class="mt-2 w-full border-gray-300 rounded-xl">
            </div>

            <div class="md:col-span-2">
                <label class="block font-semibold text-gray-800">Currículum (PDF) *</label>
                <input type="file" name="cv" accept="application/pdf" required
                       class="mt-2 w-full border-gray-300 rounded-xl">
            </div>

            <div class="md:col-span-2">
                <label class="block font-semibold text-gray-800">Experiencia profesional</label>
                <textarea name="experiencia" rows="3"
                          class="mt-2 w-full border-gray-300 rounded-xl">{{ old('experiencia') }}</textarea>
            </div>

        </div>

        <div class="pt-4 text-center">
            <button type="submit"
                    class="px-6 py-3 bg-indigo-600 text-white rounded-xl shadow hover:bg-indigo-700 transition font-semibold">
                Guardar y continuar
            </button>
        </div>

    </form>

</div>
