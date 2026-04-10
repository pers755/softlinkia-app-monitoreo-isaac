<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-black text-white uppercase tracking-tighter">
            SOFT<span class="text-cyan-500">LINKIA</span>
        </h2>
        <p class="text-gray-400 text-xs uppercase tracking-widest">Acceso al Panel de Control</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-cyan-500 text-xs font-bold uppercase mb-1" />
            <x-text-input id="email" 
                class="block mt-1 w-full bg-slate-800 border-slate-700 text-black placeholder-slate-500 focus:bg-[#0f172a] focus:border-cyan-500 focus:ring-cyan-500 transition-colors" 
                type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                placeholder="correo@ejemplo.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-cyan-500 text-xs font-bold uppercase mb-1" />

            <x-text-input id="password" 
                class="block mt-1 w-full bg-slate-800 border-slate-700 text-black placeholder-slate-500 focus:bg-[#0f172a] focus:border-cyan-500 focus:ring-cyan-500 transition-colors"
                type="password"
                name="password"
                required autocomplete="current-password"
                placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-slate-700 bg-slate-800 text-cyan-600 shadow-sm focus:ring-cyan-500" name="remember">
                <span class="ms-2 text-sm text-gray-400 group-hover:text-gray-300 transition-colors">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex flex-col space-y-4 mt-6">
            <x-primary-button class="w-full justify-center bg-cyan-600 hover:bg-cyan-500 text-white font-bold py-3 shadow-lg shadow-cyan-900/40 border-none transition-all active:scale-[0.98]">
                {{ __('Log in') }}
            </x-primary-button>

            @if (Route::has('password.request'))
                <a class="text-center text-xs text-gray-500 hover:text-cyan-400 transition-colors uppercase tracking-tighter" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>
    </form>
</x-guest-layout>