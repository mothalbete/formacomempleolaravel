<div class="max-w-md mx-auto bg-white border border-slate-200 rounded-2xl p-8 shadow-sm">

    {{-- Logo opcional --}}
    <div class="flex justify-center mb-6">
        <x-authentication-card-logo />
    </div>

    {{-- Errores --}}
    <x-validation-errors class="mb-4" />

    {{-- Mensaje de estado (por ejemplo, contraseña restablecida) --}}
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        {{-- Email --}}
        <div>
            <x-label for="email" value="Correo electrónico" class="font-semibold text-slate-700" />
            <x-input id="email"
                     class="mt-1 block w-full rounded-xl border-slate-300"
                     type="email"
                     name="email"
                     :value="old('email')"
                     required
                     autofocus
                     autocomplete="username" />
        </div>

        {{-- Contraseña --}}
        <div>
            <x-label for="password" value="Contraseña" class="font-semibold text-slate-700" />
            <x-input id="password"
                     class="mt-1 block w-full rounded-xl border-slate-300"
                     type="password"
                     name="password"
                     required
                     autocomplete="current-password" />
        </div>

        {{-- Recordarme --}}
        <div class="flex items-center gap-2">
            <x-checkbox id="remember_me" name="remember" />
            <label for="remember_me" class="text-sm text-slate-600">Recordarme</label>
        </div>

        {{-- Acciones --}}
        <div class="flex items-center justify-between pt-2">

            {{-- Cambiar a pestaña de registro --}}
            <button type="button"
                    @click="$dispatch('switch-tab', { tab: 'register' })"
                    class="text-sm text-slate-600 hover:text-slate-900 underline">
                Crear cuenta
            </button>

            <div class="flex items-center gap-4">

                {{-- Recuperar contraseña --}}
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-sm text-slate-600 hover:text-slate-900 underline">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif

                {{-- Botón login --}}
                <x-button class="px-6 py-3 rounded-xl bg-slate-900 hover:bg-slate-800">
                    Acceder
                </x-button>
            </div>

        </div>

    </form>
</div>
