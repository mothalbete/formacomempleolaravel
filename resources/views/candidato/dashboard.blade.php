<x-app-layout>

    <div class="max-w-6xl mx-auto py-14 px-6 md:px-10" x-data="{ tab: 'perfil' }">

        {{-- Encabezado --}}
        <header class="space-y-3 mb-10">
            <h1 class="text-5xl font-extrabold text-gray-900 tracking-tight">
                Panel de Candidato
            </h1>
            <p class="text-gray-600 text-xl max-w-3xl leading-relaxed">
                Gestiona tu perfil profesional, descubre nuevas oportunidades y sigue tus candidaturas.
            </p>
        </header>

        {{-- Pestañas --}}
        <div class="border-b border-gray-300 mb-10">
            <nav class="-mb-px flex gap-14 text-lg font-semibold">

                <button type="button" @click="tab = 'perfil'"
                    :class="tab === 'perfil'
                        ? 'border-indigo-600 text-indigo-700'
                        : 'border-transparent text-gray-500 hover:text-gray-700'"
                    class="pb-5 border-b-4 transition px-2">
                    Perfil
                </button>

                <button type="button" @click="tab = 'ofertas'"
                    :class="tab === 'ofertas'
                        ? 'border-indigo-600 text-indigo-700'
                        : 'border-transparent text-gray-500 hover:text-gray-700'"
                    class="pb-5 border-b-4 transition px-2">
                    Ofertas disponibles
                </button>

                <button type="button" @click="tab = 'candidaturas'"
                    :class="tab === 'candidaturas'
                        ? 'border-indigo-600 text-indigo-700'
                        : 'border-transparent text-gray-500 hover:text-gray-700'"
                    class="pb-5 border-b-4 transition px-2">
                    Mis candidaturas
                </button>

            </nav>
        </div>

        {{-- TAB: Perfil --}}
        <section x-show="tab === 'perfil'" x-cloak>
            @include('candidato.partials.perfil')
        </section>

        {{-- TAB: Ofertas --}}
        <section x-show="tab === 'ofertas'" x-cloak>
            @include('candidato.partials.ofertas', ['ofertas' => $ofertas])
        </section>

        {{-- TAB: Candidaturas --}}
        <section x-show="tab === 'candidaturas'" x-cloak>
            @include('candidato.partials.candidaturas', ['candidaturas' => $misCandidaturas])
        </section>

    </div>

</x-app-layout>
