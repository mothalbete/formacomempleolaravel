<x-app-layout>

<div class="max-w-6xl mx-auto py-14 px-6 md:px-10" x-data="{ tab: 'crear' }">

    {{-- Encabezado --}}
    <header class="space-y-3 mb-10">
        <h1 class="text-4xl font-bold text-gray-900">Panel de Empresa</h1>
        <p class="text-gray-600 text-lg max-w-3xl">
            Gestiona tus ofertas, revisa tus publicaciones y mantén tu perfil actualizado.
        </p>
    </header>

    {{-- Pestañas estilo tarjetas --}}
    <nav class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-12">

        <button 
            @click="tab = 'crear'"
            :class="tab === 'crear' 
                ? 'bg-indigo-600 text-white shadow-lg' 
                : 'bg-white text-gray-700 border border-gray-200 hover:bg-gray-50'"
            class="p-4 rounded-xl text-lg font-semibold transition text-left">
            Publicar nueva oferta
            <p class="text-sm font-normal opacity-80">Crea una oferta y publícala al instante.</p>
        </button>

        <button 
            @click="tab = 'ver'"
            :class="tab === 'ver' 
                ? 'bg-indigo-600 text-white shadow-lg' 
                : 'bg-white text-gray-700 border border-gray-200 hover:bg-gray-50'"
            class="p-4 rounded-xl text-lg font-semibold transition text-left">
            Ver mis ofertas
            <p class="text-sm font-normal opacity-80">Consulta y gestiona tus publicaciones.</p>
        </button>

        <button 
            @click="tab = 'editar'"
            :class="tab === 'editar' 
                ? 'bg-indigo-600 text-white shadow-lg' 
                : 'bg-white text-gray-700 border border-gray-200 hover:bg-gray-50'"
            class="p-4 rounded-xl text-lg font-semibold transition text-left">
            Editar perfil
            <p class="text-sm font-normal opacity-80">Actualiza los datos de tu empresa.</p>
        </button>

    </nav>

    {{-- CONTENIDO DE LAS PESTAÑAS --}}
    <div class="bg-white rounded-2xl shadow-sm p-8 border border-gray-100">

        {{-- Crear oferta --}}
        <div x-show="tab === 'crear'" x-transition class="space-y-6">
            <h2 class="text-2xl font-semibold text-gray-800">Publicar nueva oferta</h2>
            @include('empresa.ofertas.form-crear')
        </div>

        {{-- Ver ofertas --}}
        <div x-show="tab === 'ver'" x-transition class="space-y-6">
            <h2 class="text-2xl font-semibold text-gray-800">Mis ofertas</h2>
            @include('empresa.ofertas.lista')
        </div>

        {{-- Editar perfil --}}
        <div x-show="tab === 'editar'" x-transition class="space-y-6">
            <h2 class="text-2xl font-semibold text-gray-800">Editar perfil de empresa</h2>
            @include('empresa.perfil.form-editar')
        </div>

    </div>

</div>

</x-app-layout>
