<x-guest-layout>
<div class="bg-white text-slate-900" x-data="{ tab: 'info' }">

    {{-- HERO PRINCIPAL --}}
    <section class="bg-slate-50 border-b border-slate-200 py-16">
        <div class="mx-auto max-w-6xl px-6 lg:px-10 text-center space-y-6">

            <h1 class="text-4xl lg:text-5xl font-extrabold leading-tight">
                Agencia de Colocación Formacom
            </h1>

            <p class="text-lg text-slate-600 max-w-3xl mx-auto">
                Un portal pensado para gestionar ofertas y candidaturas de forma ordenada:
                publicación, inscripción, estados del proceso y comunicación interna.
            </p>

            {{-- CTA: pestañas --}}
            <div class="flex justify-center gap-4 pt-4">
                <button @click="tab = 'info'"
                        :class="tab === 'info' ? 'bg-slate-900 text-white' : 'bg-white border border-slate-300 text-slate-700'"
                        class="px-6 py-3 rounded-xl font-semibold transition">
                    Información
                </button>

                <button @click="tab = 'login'"
                        :class="tab === 'login' ? 'bg-slate-900 text-white' : 'bg-white border border-slate-300 text-slate-700'"
                        class="px-6 py-3 rounded-xl font-semibold transition">
                    Iniciar sesión
                </button>

                <button @click="tab = 'register'"
                        :class="tab === 'register' ? 'bg-slate-900 text-white' : 'bg-white border border-slate-300 text-slate-700'"
                        class="px-6 py-3 rounded-xl font-semibold transition">
                    Crear cuenta
                </button>
            </div>

        </div>
    </section>


    {{-- CONTENIDO DE PESTAÑAS --}}
    <section class="py-16">
        <div class="mx-auto max-w-4xl px-6 lg:px-10">

            {{-- INFO --}}
            <div x-show="tab === 'info'" x-transition>
                <h3 class="text-2xl font-semibold">¿Qué ofrece la plataforma?</h3>

                <p class="mt-4 text-slate-600 leading-relaxed">
                    Un entorno seguro con registro, verificación de email, recuperación de contraseña y panel por perfiles.
                    Las empresas publican ofertas y gestionan candidaturas; los candidatos crean su perfil, adjuntan CV y se inscriben;
                    y el administrador valida empresas y supervisa el sistema.
                </p>

                <h3 class="text-2xl font-semibold mt-10">¿Por qué usar Formacom Empleo?</h3>

                <div class="mt-8 grid gap-4 md:grid-cols-2">
                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="font-semibold">Respuesta a la demanda laboral</div>
                        <p class="mt-2 text-slate-600 text-sm">
                            Centraliza ofertas y candidaturas para acelerar procesos de selección.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="font-semibold">Oportunidades rápidas para candidatos</div>
                        <p class="mt-2 text-slate-600 text-sm">
                            Inscripción sencilla y seguimiento del estado del proceso desde el panel.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="font-semibold">Mejor organización para empresas</div>
                        <p class="mt-2 text-slate-600 text-sm">
                            Estados, notas y filtros para trabajar con orden y priorizar perfiles.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="font-semibold">Seguridad y control</div>
                        <p class="mt-2 text-slate-600 text-sm">
                            Verificación de email, recuperación de contraseña y 2FA para cuentas sensibles.
                        </p>
                    </div>
                </div>
            </div>


            {{-- LOGIN --}}
            <div x-show="tab === 'login'" x-transition>
                @include('auth.login')
            </div>

            {{-- REGISTER --}}
            <div x-show="tab === 'register'" x-transition>
                @include('auth.register')
            </div>

        </div>
    </section>


    {{-- FOOTER --}}
    <footer class="border-t border-slate-200">
        <div class="mx-auto max-w-6xl px-6 lg:px-10 py-8 text-xs text-slate-500 flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between">
            <div>© {{ date('Y') }} Formacom Empleo</div>
            <div class="flex gap-4">
                <a class="hover:text-slate-700" href="https://www.formacom.es/" target="_blank" rel="noopener">formacom.es</a>
                <a class="hover:text-slate-700" href="#">Privacidad</a>
                <a class="hover:text-slate-700" href="#">Cookies</a>
            </div>
        </div>
    </footer>

</div>
</x-guest-layout>
