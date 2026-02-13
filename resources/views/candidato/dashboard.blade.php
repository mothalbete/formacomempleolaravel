<x-app-layout>

<div 
    class="max-w-6xl mx-auto py-14 px-6 md:px-10"
    x-data="{ tab: 'perfil' }"
>

    {{-- Encabezado --}}
    <header class="space-y-3 mb-10">
        <h1 class="text-4xl font-bold text-gray-900">Panel de Candidato</h1>
        <p class="text-gray-600 text-lg max-w-3xl">
            Gestiona tu perfil profesional, descubre nuevas oportunidades y sigue tus candidaturas.
        </p>
    </header>

    {{-- Pestañas estilo tarjetas --}}
    <nav class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-12">

        {{-- PERFIL --}}
        <button 
            @click="tab = 'perfil'"
            :class="tab === 'perfil' 
                ? 'bg-indigo-600 text-white shadow-lg' 
                : 'bg-white text-gray-700 border border-gray-200 hover:bg-gray-50'"
            class="p-4 rounded-xl text-lg font-semibold transition text-left"
        >
            Mi perfil
            <p class="text-sm font-normal opacity-80">Actualiza tus datos personales y profesionales.</p>
        </button>

        {{-- OFERTAS --}}
        <button 
            @click="tab = 'ofertas'"
            :class="tab === 'ofertas' 
                ? 'bg-indigo-600 text-white shadow-lg' 
                : 'bg-white text-gray-700 border border-gray-200 hover:bg-gray-50'"
            class="p-4 rounded-xl text-lg font-semibold transition text-left"
        >
            Ofertas disponibles
            <p class="text-sm font-normal opacity-80">Descubre nuevas oportunidades laborales.</p>
        </button>

        {{-- CANDIDATURAS --}}
        <button 
            @click="tab = 'candidaturas'"
            :class="tab === 'candidaturas' 
                ? 'bg-indigo-600 text-white shadow-lg' 
                : 'bg-white text-gray-700 border border-gray-200 hover:bg-gray-50'"
            class="p-4 rounded-xl text-lg font-semibold transition text-left"
        >
            Mis candidaturas
            <p class="text-sm font-normal opacity-80">Consulta el estado de tus postulaciones.</p>
        </button>

    </nav>

    {{-- CONTENIDO --}}
    <div class="bg-white rounded-2xl shadow-sm p-8 border border-gray-100">

        {{-- PERFIL --}}
        <div x-show="tab === 'perfil'" x-transition class="space-y-6">
            @include('candidato.partials.perfil')
        </div>

        {{-- OFERTAS --}}
        <div x-show="tab === 'ofertas'" x-transition class="space-y-6">
            @include('candidato.partials.ofertas', ['ofertas' => $ofertas])
        </div>

        {{-- CANDIDATURAS --}}
        <div x-show="tab === 'candidaturas'" x-transition class="space-y-6">
            @include('candidato.partials.candidaturas', ['candidaturas' => $misCandidaturas])
        </div>

    </div>

</div>

</x-app-layout>
