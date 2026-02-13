<x-app-layout>

<div 
    class="max-w-7xl mx-auto py-14 px-6 md:px-10"
    x-data="{ tab: 'empresas' }"
>

    <header class="space-y-3 mb-10">
        <h1 class="text-4xl font-bold text-gray-900">Panel de Administración</h1>
        <p class="text-gray-600 text-lg max-w-3xl">
            Gestiona empresas, ofertas y usuarios de la plataforma.
        </p>
    </header>

    {{-- PESTAÑAS --}}
    <nav class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-12">

        {{-- EMPRESAS --}}
        <button 
            @click="tab = 'empresas'"
            :class="tab === 'empresas' 
                ? 'bg-indigo-600 text-white shadow-lg' 
                : 'bg-white text-gray-700 border border-gray-200 hover:bg-gray-50'"
            class="p-4 rounded-xl text-lg font-semibold transition text-left"
        >
            Empresas
            <p class="text-sm font-normal opacity-80">Validación y gestión de empresas.</p>
        </button>

        {{-- OFERTAS --}}
        <button 
            @click="tab = 'ofertas'"
            :class="tab === 'ofertas' 
                ? 'bg-indigo-600 text-white shadow-lg' 
                : 'bg-white text-gray-700 border border-gray-200 hover:bg-gray-50'"
            class="p-4 rounded-xl text-lg font-semibold transition text-left"
        >
            Ofertas
            <p class="text-sm font-normal opacity-80">Validación de ofertas publicadas.</p>
        </button>

        {{-- USUARIOS --}}
        <button 
            @click="tab = 'usuarios'"
            :class="tab === 'usuarios' 
                ? 'bg-indigo-600 text-white shadow-lg' 
                : 'bg-white text-gray-700 border border-gray-200 hover:bg-gray-50'"
            class="p-4 rounded-xl text-lg font-semibold transition text-left"
        >
            Usuarios
            <p class="text-sm font-normal opacity-80">Candidatos y empresas registradas.</p>
        </button>

    </nav>

    {{-- CONTENIDO --}}
    <div class="bg-white rounded-2xl shadow-sm p-8 border border-gray-100">

        {{-- EMPRESAS --}}
        <div x-show="tab === 'empresas'" x-transition>
            @include('admin.partials.empresas')
        </div>

        {{-- OFERTAS --}}
        <div x-show="tab === 'ofertas'" x-transition>
            @include('admin.partials.ofertas')
        </div>

        {{-- USUARIOS --}}
        <div x-show="tab === 'usuarios'" x-transition>
            @include('admin.partials.usuarios')
        </div>

    </div>

</div>

</x-app-layout>
