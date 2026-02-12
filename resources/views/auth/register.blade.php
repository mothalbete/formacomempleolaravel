<div class="max-w-md mx-auto bg-white border border-slate-200 rounded-2xl p-8 shadow-sm">

    {{-- Logo opcional --}}
    <div class="flex justify-center mb-6">
        <x-authentication-card-logo />
    </div>

    {{-- Errores --}}
    <x-validation-errors class="mb-4" />

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        {{-- Nombre --}}
        <div>
            <x-label for="name" value="Nombre" class="font-semibold text-slate-700" />
            <x-input id="name"
                     class="mt-1 block w-full rounded-xl border-slate-300"
                     type="text"
                     name="name"
                     :value="old('name')"
                     required
                     autofocus
                     autocomplete="name" />
        </div>

        {{-- Email --}}
        <div>
            <x-label for="email" value="Correo electrónico" class="font-semibold text-slate-700" />
            <x-input id="email"
                     class="mt-1 block w-full rounded-xl border-slate-300"
                     type="email"
                     name="email"
                     :value="old('email')"
                     required
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
                     autocomplete="new-password" />
        </div>

        {{-- Confirmación --}}
        <div>
            <x-label for="password_confirmation" value="Confirmar contraseña" class="font-semibold text-slate-700" />
            <x-input id="password_confirmation"
                     class="mt-1 block w-full rounded-xl border-slate-300"
                     type="password"
                     name="password_confirmation"
                     required
                     autocomplete="new-password" />
        </div>

        {{-- Términos --}}
        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="flex items-start gap-2">
                <x-checkbox name="terms" id="terms" required />

                <label for="terms" class="text-sm text-slate-600 leading-tight">
                    {!! __('Acepto los :terms_of_service y la :privacy_policy', [
                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline hover:text-slate-800">'.__('Condiciones de servicio').'</a>',
                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline hover:text-slate-800">'.__('Política de privacidad').'</a>',
                    ]) !!}
                </label>
            </div>
        @endif

        {{-- Botones --}}
        <div class="flex items-center justify-between pt-2">

            <button type="button"
                    @click="$dispatch('switch-tab', { tab: 'login' })"
                    class="text-sm text-slate-600 hover:text-slate-900 underline">
                ¿Ya tienes cuenta?
            </button>

            <x-button class="px-6 py-3 rounded-xl bg-slate-900 hover:bg-slate-800">
                Crear cuenta
            </x-button>
        </div>

    </form>
</div>
