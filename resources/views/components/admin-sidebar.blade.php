<aside {{ $attributes->merge(['class' => 'w-64 bg-white h-screen shadow-md flex flex-col justify-between']) }}>
    <div class="p-6">
        <nav class="space-y-2">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <span class="mr-3">
                    <!-- Home Icon -->
                    <svg width="28" height="28" viewBox="0 0 32 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M4 11.411V27.411C4 27.7646 4.14048 28.1037 4.39052 28.3538C4.64057 28.6038 4.97971 28.7443 5.33333 28.7443H12C12.3536 28.7443 12.6928 28.6038 12.9428 28.3538C13.1929 28.1037 13.3333 27.7646 13.3333 27.411V18.0776H18.6667V27.411C18.6667 27.7646 18.8071 28.1037 19.0572 28.3538C19.3072 28.6038 19.6464 28.7443 20 28.7443H26.6667C27.0203 28.7443 27.3594 28.6038 27.6095 28.3538C27.8595 28.1037 28 27.7646 28 27.411V11.411C28 11.204 27.9518 10.9998 27.8592 10.8147C27.7667 10.6295 27.6323 10.4685 27.4667 10.3443L16.8 2.3443C16.5692 2.17121 16.2885 2.07764 16 2.07764C15.7115 2.07764 15.4308 2.17121 15.2 2.3443L4.53333 10.3443C4.36774 10.4685 4.23333 10.6295 4.14076 10.8147C4.04819 10.9998 4 11.204 4 11.411ZM6.66667 12.0776L16 5.07764L25.3333 12.0776V26.0776H21.3333V16.7443C21.3333 16.3907 21.1929 16.0515 20.9428 15.8015C20.6928 15.5514 20.3536 15.411 20 15.411H12C11.6464 15.411 11.3072 15.5514 11.0572 15.8015C10.8071 16.0515 10.6667 16.3907 10.6667 16.7443V26.0776H6.66667V12.0776Z"
                            fill="black"/>
                    </svg>
                </span>
                {{ __('Inicio') }}
            </x-nav-link>

            <x-nav-link :href="route('estudiantes.index')" :active="request()->routeIs('estudiantes.index')">
                <span class="mr-3">
                    <!-- Student Icon -->
                <svg xmlns="http://www.w3.org/2000/svg"
                     width="28"
                     height="28"
                     viewBox="0 0 24 24">
                    <g fill="none" stroke="#000000"
                       stroke-linecap="round"
                       stroke-linejoin="round"
                       stroke-width="1.5"
                       color="#000000"><path
                            d="M14 3.5c3.771 0 5.657 0 6.828 1.245S22 7.993 22 12s0 6.01-1.172 7.255S17.771 20.5 14 20.5h-4c-3.771 0-5.657 0-6.828-1.245S2 16.007 2 12s0-6.01 1.172-7.255S6.229 3.5 10 3.5z"/><path
                            d="M5 15.5c1.609-2.137 5.354-2.254 7 0m-1.751-5.25a1.75 1.75 0 1 1-3.5 0a1.75 1.75 0 0 1 3.5 0M15 9.5h4m-4 4h2"/></g></svg>
                </span>
                {{ __('Estudiantes') }}
            </x-nav-link>

            <x-nav-link :href="route('maestros.index')" :active="request()->routeIs('maestros.index')">
                <span class="mr-3">
                    <!-- Student Icon -->
               <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
                   <g fill="none"
                      stroke="#333333"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="1.5"
                      color="#333333"><path
                           d="M2 2h14c1.886 0 2.828 0 3.414.586S20 4.114 20 6v6c0 1.886 0 2.828-.586 3.414S17.886 16 16 16H9m1-9.5h6M2 17v-4c0-.943 0-1.414.293-1.707S3.057 11 4 11h2m-4 6h4m-4 0v5m4-5v-6m0 6v5m0-11h6"/><path
                           d="M6 6.5a2 2 0 1 1-4 0a2 2 0 0 1 4 0"/></g></svg>
                </span>
                {{ __('Maestros') }}
            </x-nav-link>

            <x-nav-link :href="route('biblioteca.index')" :active="request()->routeIs('biblioteca.index')">
                <span class="mr-3">
                    <!-- library Icon -->
               <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"><g fill="none"
                                                                                                     stroke="#000000"
                                                                                                     stroke-linecap="round"
                                                                                                     stroke-linejoin="round"
                                                                                                     stroke-width="1.5"><path
                           d="M14 11.998C14 9.506 11.683 7 8.857 7H7.143C4.303 7 2 9.238 2 11.998c0 2.378 1.71 4.368 4 4.873a5.3 5.3 0 0 0 1.143.124"/><path
                           d="M10 11.998c0 2.491 2.317 4.997 5.143 4.997h1.714c2.84 0 5.143-2.237 5.143-4.997c0-2.379-1.71-4.37-4-4.874A5.3 5.3 0 0 0 16.857 7"/></g></svg>
                </span>
                {{ __('Biblioteca') }}
            </x-nav-link>

            <x-nav-link :href="route('boletas.index')" :active="request()->routeIs('boletas.index')">
                <span class="mr-3">
                    <!-- Boleta Icon -->
              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"><g fill="none"
                                                                                                    stroke="#000000"
                                                                                                    stroke-linecap="round"
                                                                                                    stroke-linejoin="round"
                                                                                                    stroke-width="1.5"><path
                          d="M16.5 4H8a4 4 0 0 0-4 4v8.5a4 4 0 0 0 4 4h6.843a4 4 0 0 0 2.829-1.172l1.656-1.656a4 4 0 0 0 1.172-2.829V8a4 4 0 0 0-4-4"/><path
                          d="M20.5 14H17a3 3 0 0 0-3 3v3.5M8 8h7.5M8 12h5"/></g></svg>
                </span>
                {{ __('Boletas') }}
            </x-nav-link>
        </nav>
    </div>
</aside>
