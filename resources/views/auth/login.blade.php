<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')"/>

    <div class="px-4 md:px-4 text-center md:text-left">
        <h1 class="text-2xl md:text-4xl font-bold text-primary leading-tight">
            El espacio para tu aprendizaje en <br class="hidden md:block" />
            CEENP Neurociencias
        </h1>
        <p class="mt-4 text-sm md:text-base text-gray-600">
            ¡Bienvenido de vuelta! Por favor, inicia sesión con tu cuenta.
        </p>
    </div>


    <form method="POST" action="{{ route('login') }}" class="mt-8">
        @csrf

        <div class="lg:w-3/4 px-4 justify-center">
            <!-- Email Address -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Tu correo')"/>

                <div class="relative w-full">
                    <svg
                        class="absolute top-1/2 left-3 -translate-y-1/2"
                        width="24" height="24" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g opacity="0.5">
                            <path
                                d="M21 8C21 9.32608 20.4732 10.5979 19.5355 11.5355C18.5978 12.4732 17.3261 13 16 13C14.6739 13 13.4021 12.4732 12.4645 11.5355C11.5268 10.5979 11 9.32608 11 8C11 6.67392 11.5268 5.40215 12.4645 4.46447C13.4021 3.52678 14.6739 3 16 3C17.3261 3 18.5978 3.52678 19.5355 4.46447C20.4732 5.40215 21 6.67392 21 8ZM6.00133 26.824C6.04417 24.2005 7.11644 21.6989 8.9869 19.8587C10.8573 18.0186 13.3761 16.9873 16 16.9873C18.6239 16.9873 21.1426 18.0186 23.0131 19.8587C24.8835 21.6989 25.9558 24.2005 25.9987 26.824C22.8618 28.2624 19.4509 29.0047 16 29C12.432 29 9.04533 28.2213 6.00133 26.824Z"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round"/>
                        </g>
                    </svg>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        class="block w-full pl-10 pr-4 !py-3.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Tu correo"
                        required
                        :value="old('email')"
                        autofocus
                        autocomplete="username"
                    />
                </div>


                <x-input-error :messages="$errors->get('email')" class="mt-2"/>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Tu contraseña')"/>

                <div class="relative w-full">

                    <svg
                        width="24" height="24"
                        viewBox="0 0 32 32"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        class="absolute top-1/2 left-3 -translate-y-1/2 text-gray-500"
                    >
                        <g opacity="0.5">
                            <path
                                d="M22 14V9C22 7.4087 21.3679 5.88258 20.2426 4.75736C19.1174 3.63214 17.5913 3 16 3C14.4087 3 12.8826 3.63214 11.7574 4.75736C10.6321 5.88258 10 7.4087 10 9V14M9 29H23C23.7956 29 24.5587 28.6839 25.1213 28.1213C25.6839 27.5587 26 26.7957 26 26V17C26 16.2044 25.6839 15.4413 25.1213 14.8787C24.5587 14.3161 23.7956 14 23 14H9C8.20435 14 7.44129 14.3161 6.87868 14.8787C6.31607 15.4413 6 16.2044 6 17V26C6 26.7957 6.31607 27.5587 6.87868 28.1213C7.44129 28.6839 8.20435 29 9 29Z"
                                stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>
                    </svg>


                    <x-text-input id="password" class="block mt-1 w-full"
                                  type="password"
                                  name="password"
                                  class="block w-full pl-10 pr-4 !py-3.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                  required
                                  autocomplete="current-password"
                                  placeholder="Tu contraseña"
                    />
                </div>


                <x-input-error :messages="$errors->get('password')" class="mt-2"/>
            </div>

            <!-- Remember Me -->
            <div class="block mt-4 flex justify-between">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                           name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Recuerdame') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                       href="{{ route('password.request') }}">
                        {{ __('¿Olvidaste tu contraseña?') }}
                    </a>
                @endif
            </div>

            <div class="flex items-center justify-center w-full mt-6">
                <x-primary-button class="ms-3">
                    {{ __('Iniciar Sesión') }}
                </x-primary-button>
            </div>

        </div>
    </form>
</x-guest-layout>
