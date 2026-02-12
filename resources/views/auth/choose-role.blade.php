<x-guest-layout>

    <style>
        .form-enter {
            opacity: 0;
            transform: translateY(200px);
        }

        .form-enter-active {
            opacity: 1;
            transform: translateY(0);
            transition: opacity 1.2s ease-in-out, transform 1s ease-in-out;
        }
    </style>

    <div x-data="roleSelector()" class="min-h-screen flex items-center justify-center px-6 relative overflow-hidden">

        {{-- ========================= --}}
        {{--   TARJETAS INICIALES     --}}
        {{-- ========================= --}}
        <div
            x-show="step === 'choose'"
            x-transition.opacity.duration.400ms
            class="max-w-4xl w-full"
        >
            <h1 class="text-3xl font-bold text-center mb-6">Elige tu tipo de cuenta</h1>

            <p class="text-center text-gray-600 mb-12">
                Cuéntanos cómo quieres usar la plataforma para ofrecerte la mejor experiencia.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                {{-- CANDIDATO --}}
                <div
                    class="role-card bg-white shadow-md rounded-xl p-6 hover:shadow-xl transition-all duration-300 border cursor-pointer flex flex-col min-h-[500px]"
                    @click="selectCard($el, 'candidato')"
                >
                    <img src="/images/candidato.png" class="w-full h-48 object-cover rounded-md mb-4">
                    <h2 class="text-xl font-semibold mb-2">Soy candidato</h2>
                    <p class="text-gray-600 text-sm flex-grow">
                        Completa tu perfil profesional y accede a ofertas adaptadas a ti.
                    </p>
                </div>

                {{-- EMPRESA --}}
                <div
                    class="role-card bg-white shadow-md rounded-xl p-6 hover:shadow-xl transition-all duration-300 border cursor-pointer flex flex-col min-h-[500px]"
                    @click="selectCard($el, 'empresa')"
                >
                    <img src="/images/empresa.png" class="w-full h-48 object-cover rounded-md mb-4">
                    <h2 class="text-xl font-semibold mb-2">Soy empresa</h2>
                    <p class="text-gray-600 text-sm flex-grow">
                        Publica ofertas, gestiona candidatos y encuentra el talento ideal.
                    </p>
                </div>

            </div>
        </div>


        {{-- ========================= --}}
        {{--   FORMULARIO EMPRESA     --}}
        {{-- ========================= --}}
        <div 
            x-cloak 
            x-show="step === 'empresa'" 
            x-ref="formEmpresa"
            class="form-enter w-full max-w-5xl mx-auto absolute inset-0 flex flex-col bg-white"
        >
            {{-- Barra fija --}}
            <div class="sticky top-0 z-50 bg-white py-4 px-6 shadow-sm flex items-center gap-3">
                <button @click="goBack"
                    class="inline-flex items-center gap-2 px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-md shadow-sm text-gray-700 text-sm">
                    ← Volver a elegir tipo de cuenta
                </button>
            </div>

            {{-- Contenido --}}
            <div class="flex-1 overflow-y-auto px-6 pb-20">
                @include('auth.register-empresa-extra')
            </div>
        </div>


        {{-- ========================= --}}
        {{--   FORMULARIO CANDIDATO   --}}
        {{-- ========================= --}}
        <div 
            x-cloak 
            x-show="step === 'candidato'" 
            x-ref="formCandidato"
            class="form-enter w-full max-w-5xl mx-auto absolute inset-0 flex flex-col bg-white"
        >
            {{-- Barra fija --}}
            <div class="sticky top-0 z-50 bg-white py-4 px-6 shadow-sm flex items-center gap-3">
                <button @click="goBack"
                    class="inline-flex items-center gap-2 px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-md shadow-sm text-gray-700 text-sm">
                    ← Volver a elegir tipo de cuenta
                </button>
            </div>

            {{-- Contenido --}}
            <div class="flex-1 overflow-y-auto px-6 pb-20">
                @include('candidato.completar-perfil')
            </div>
        </div>

    </div>


    {{-- ========================= --}}
    {{--   SCRIPT ALPINE.JS        --}}
    {{-- ========================= --}}
    <script>
        function roleSelector() {
            return {
                step: 'choose',
                selectedRole: null,

                selectCard(card, role) {
                    this.selectedRole = role;

                    document.querySelectorAll('.role-card').forEach(c => {
                        if (c !== card) {
                            c.style.transition = "opacity 0.4s ease";
                            c.style.opacity = 0;
                            c.style.pointerEvents = "none";
                        }
                    });

                    const rect = card.getBoundingClientRect();
                    const width = rect.width;
                    const height = rect.height;

                    card.style.width = width + "px";
                    card.style.height = height + "px";
                    card.style.position = "fixed";
                    card.style.zIndex = "50";
                    card.style.left = rect.left + "px";
                    card.style.top = rect.top + "px";

                    card.getBoundingClientRect();

                    const targetX = window.innerWidth / 2 - width / 2;
                    const targetY = window.innerHeight / 2 - height / 2;

                    card.style.transition = "left 0.6s ease, top 0.6s ease, opacity 0.5s ease";
                    card.style.left = targetX + "px";
                    card.style.top = targetY + "px";

                    setTimeout(() => card.style.opacity = 0, 450);

                    setTimeout(() => {
                        this.step = role;

                        this.$nextTick(() => {
                            const form = role === 'empresa'
                                ? this.$refs.formEmpresa
                                : this.$refs.formCandidato;

                            void form.offsetWidth;
                            form.classList.add('form-enter-active');
                        });
                    }, 1200);
                },

                goBack() {
                    this.step = 'choose';

                    document.querySelectorAll('.role-card').forEach(c => {
                        c.style.opacity = 1;
                        c.style.pointerEvents = "";
                        c.style.position = "";
                        c.style.width = "";
                        c.style.height = "";
                        c.style.left = "";
                        c.style.top = "";
                        c.style.zIndex = "";
                        c.style.transition = "";
                    });

                    [this.$refs.formEmpresa, this.$refs.formCandidato].forEach(form => {
                        if (!form) return;
                        form.classList.remove('form-enter-active');
                        form.classList.add('form-enter');
                    });
                }
            }
        }
    </script>

</x-guest-layout>
