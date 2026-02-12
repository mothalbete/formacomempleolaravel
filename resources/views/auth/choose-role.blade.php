<x-guest-layout>

    <div class="min-h-screen flex items-center justify-center px-6">

        <div class="max-w-4xl w-full">

            <h1 class="text-3xl font-bold text-center mb-6">
                Elige tu tipo de cuenta
            </h1>

            <p class="text-center text-gray-600 mb-12">
                Cuéntanos cómo quieres usar la plataforma para ofrecerte la mejor experiencia.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch">

                {{-- OPCIÓN CANDIDATO --}}
                <form method="POST" action="{{ route('choose.role.store') }}" class="h-full">
                    @csrf
                    <input type="hidden" name="role" value="candidato">

                    <button type="submit"
                        class="w-full h-full bg-white shadow-md rounded-xl p-6 hover:shadow-xl transition border border-gray-200 text-left flex flex-col min-h-[500px]">

                        <img src="/images/candidato.png" alt="Candidato"
                             class="w-full h-48 object-cover rounded-md mb-4">

                        <h2 class="text-xl font-semibold mb-2">Soy candidato</h2>

                        <p class="text-gray-600 text-sm flex-grow">
                            Busca ofertas de empleo, gestiona tu perfil profesional y postúlate a oportunidades que encajen contigo.
                        </p>
                    </button>
                </form>


                {{-- OPCIÓN EMPRESA --}}
                <form method="POST" action="{{ route('choose.role.store') }}" class="h-full">
                    @csrf
                    <input type="hidden" name="role" value="empresa">

                    <button type="submit"
                        class="w-full h-full bg-white shadow-md rounded-xl p-6 hover:shadow-xl transition border border-gray-200 text-left flex flex-col min-h-[500px]">

                        <img src="/images/empresa.png" alt="Empresa"
                             class="w-full h-48 object-cover rounded-md mb-4">

                        <h2 class="text-xl font-semibold mb-2">Soy empresa</h2>

                        <p class="text-gray-600 text-sm flex-grow">
                            Publica ofertas, gestiona candidatos y encuentra el talento ideal para tu organización.
                        </p>
                    </button>
                </form>

            </div>
        </div>

    </div>

</x-guest-layout>
