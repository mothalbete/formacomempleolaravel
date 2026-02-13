@php
    $user = auth()->user();
@endphp

<div class="max-w-4xl mx-auto">

    <h1 class="text-3xl font-bold mb-6 text-center">
        Completa los datos de tu empresa
    </h1>

    <p class="text-gray-600 text-center mb-10">
        Estos datos nos permiten crear tu perfil de empresa.
    </p>

    <form id="empresa-form" method="POST" action="{{ route('empresa.register.extra.store') }}"
          enctype="multipart/form-data" class="space-y-6">

        @csrf

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div>
                <label class="block font-medium">CIF *</label>
                <input type="text" name="cif" value="{{ old('cif') }}" class="w-full border-gray-300 rounded-md" required>
            </div>

            <div>
                <label class="block font-medium">Teléfono</label>
                <input type="text" name="telefono" value="{{ old('telefono') }}" class="w-full border-gray-300 rounded-md">
            </div>

            <div>
                <label class="block font-medium">Página web</label>
                <input type="text" name="web" value="{{ old('web') }}" class="w-full border-gray-300 rounded-md">
            </div>

            <div class="md:col-span-3">
                <label class="block font-medium">Nombre de la empresa *</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}" class="w-full border-gray-300 rounded-md" required>
            </div>

            <div>
                <label class="block font-medium">Persona de contacto</label>
                <input type="text" name="persona_contacto"
                       value="{{ old('persona_contacto', $user?->name) }}"
                       class="w-full border-gray-300 rounded-md">
            </div>

            <div>
                <label class="block font-medium">Email de contacto</label>
                <input type="email" name="email_contacto"
                       value="{{ old('email_contacto', $user?->email) }}"
                       class="w-full border-gray-300 rounded-md">
            </div>

            <div>
                <label class="block font-medium">Código Postal</label>
                <input type="text" name="cp" value="{{ old('cp') }}" class="w-full border-gray-300 rounded-md">
            </div>

            <div>
                <label class="block font-medium">Ciudad</label>
                <input type="text" name="ciudad" value="{{ old('ciudad') }}" class="w-full border-gray-300 rounded-md">
            </div>

            <div>
                <label class="block font-medium">Provincia</label>
                <input type="text" name="provincia" value="{{ old('provincia') }}" class="w-full border-gray-300 rounded-md">
            </div>

            <div class="md:col-span-3">
                <label class="block font-medium">Dirección</label>
                <input type="text" name="direccion" value="{{ old('direccion') }}" class="w-full border-gray-300 rounded-md">
            </div>

            <div class="md:col-span-3">
                <label class="block font-medium">Logo de la empresa</label>
                <input type="file" name="logo" class="w-full border-gray-300 rounded-md">
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
