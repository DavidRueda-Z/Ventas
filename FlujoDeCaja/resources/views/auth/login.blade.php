<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-20 h-20 mx-auto mb-4">
        </x-slot>

        <!-- Mensajes de estado -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <h2 class="text-center text-2xl font-bold text-gray-700 mb-6">Iniciar Sesión</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div>
                <x-label for="email" value="Correo Electrónico" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" required autofocus />
            </div>

            <!-- Contraseña -->
            <div class="mt-4">
                <x-label for="password" value="Contraseña" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <!-- Recordarme -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                    <span class="ml-2 text-sm text-gray-600">Recuérdame</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-6">
                <a class="text-sm text-blue-600 hover:text-blue-800" href="{{ route('password.request') }}">
                    ¿Olvidaste tu contraseña?
                </a>

                <x-button>
                    Ingresar
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
