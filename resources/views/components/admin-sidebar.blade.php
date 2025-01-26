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

            <a href="#" class="flex items-center p-2 text-gray-700 hover:bg-gray-100 rounded">
                <span class="mr-3">
                    <!-- Analytics Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11 3a8 8 0 0116 0v7a8 8 0 01-16 0V3zm5 15h-4v7h4v-7zm-9 3h4v-3H7v3zm-4 3h4v-5H3v5z"/>
                    </svg>
                </span>
                <span>Analytics</span>
            </a>
            <a href="#" class="flex items-center p-2 text-gray-700 hover:bg-gray-100 rounded">
                <span class="mr-3">
                    <!-- Messages Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 5a3 3 0 013-3h12a3 3 0 013 3v10a3 3 0 01-3 3H9l-6 3V5z"/>
                    </svg>
                </span>
                <span>Messages</span>
            </a>
        </nav>
    </div>
</aside>
