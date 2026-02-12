<div class="max-w-3xl mx-auto py-10 pb-32">

    <h1 class="text-3xl font-bold mb-6 text-center">
        Editar perfil de empresa
    </h1>

    <p class="text-gray-600 text-center mb-10">
        Actualiza la información visible en tu perfil y en tus ofertas.
    </p>

    {{-- Barra superior fija con botón de guardar --}}
    <div class="sticky top-0 z-50 py-3 mb-6 bg-white">
        <div class="flex items-center justify-center gap-3">

            <span class="text-gray-700 font-medium">
                Guardar cambios
            </span>

            <button form="empresa-edit-form" type="submit"
                class="px-3 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 transition flex items-center gap-1">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </button>

        </div>
    </div>

    {{-- FORMULARIO --}}
    <form id="empresa-edit-form" method="POST" action="{{ route('empresa.perfil.update') }}"
        enctype="multipart/form-data" class="space-y-6">

        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- CIF --}}
            <div>
                <label class="block font-medium">CIF *</label>
                <input type="text" name="cif" value="{{ old('cif', $empresa->cif) }}"
                    class="w-full border-gray-300 rounded-md" required>
                @error('cif') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            {{-- Teléfono --}}
            <div>
                <label class="block font-medium">Teléfono</label>
                <input type="text" name="telefono" value="{{ old('telefono', $empresa->telefono) }}"
                    class="w-full border-gray-300 rounded-md">
                @error('telefono') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            {{-- Nombre empresa --}}
            <div class="md:col-span-2">
                <label class="block font-medium">Nombre de la empresa *</label>
                <input type="text" name="nombre" value="{{ old('nombre', $empresa->nombre) }}"
                    class="w-full border-gray-300 rounded-md" required>
                @error('nombre') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            {{-- Web --}}
            <div>
                <label class="block font-medium">Página web</label>
                <input type="text" name="web" value="{{ old('web', $empresa->web) }}"
                    class="w-full border-gray-300 rounded-md">
                @error('web') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            {{-- Persona de contacto --}}
            <div>
                <label class="block font-medium">Persona de contacto</label>
                <input type="text" name="persona_contacto" value="{{ old('persona_contacto', $empresa->persona_contacto) }}"
                    class="w-full border-gray-300 rounded-md">
                @error('persona_contacto') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            {{-- Email contacto --}}
            <div>
                <label class="block font-medium">Email de contacto</label>
                <input type="email" name="email_contacto" value="{{ old('email_contacto', $empresa->email_contacto) }}"
                    class="w-full border-gray-300 rounded-md">
                @error('email_contacto') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            {{-- Dirección --}}
            <div class="md:col-span-2">
                <label class="block font-medium">Dirección</label>
                <input type="text" name="direccion" value="{{ old('direccion', $empresa->direccion) }}"
                    class="w-full border-gray-300 rounded-md">
                @error('direccion') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            {{-- CP --}}
            <div>
                <label class="block font-medium">Código Postal</label>
                <input type="text" name="cp" value="{{ old('cp', $empresa->cp) }}"
                    class="w-full border-gray-300 rounded-md">
                @error('cp') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            {{-- Ciudad --}}
            <div>
                <label class="block font-medium">Ciudad</label>
                <input type="text" name="ciudad" value="{{ old('ciudad', $empresa->ciudad) }}"
                    class="w-full border-gray-300 rounded-md">
                @error('ciudad') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            {{-- Provincia --}}
            <div class="md:col-span-2">
                <label class="block font-medium">Provincia</label>
                <input type="text" name="provincia" value="{{ old('provincia', $empresa->provincia) }}"
                    class="w-full border-gray-300 rounded-md">
                @error('provincia') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            {{-- Logo --}}
            <div class="md:col-span-2">
                <label class="block font-medium">Logo de la empresa</label>

                @if ($empresa->logo)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $empresa->logo) }}" alt="Logo actual"
                            class="h-20 object-contain">
                    </div>
                @endif

                <input type="file" name="logo" class="w-full border-gray-300 rounded-md">
                @error('logo') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

        </div>

    </form>

</div>
