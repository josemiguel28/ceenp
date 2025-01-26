<div x-data="{ open: false }" class="flex flex-col md:flex-row">
    <!-- Sidebar fijo (solo para pantallas grandes) -->
    <aside class="hidden md:block w-64 bg-white h-screen shadow-md flex flex-col justify-between">
        <x-admin-sidebar />
    </aside>

    <!-- Botón para abrir/cerrar el sidebar en móviles -->
    <div class="flex justify-between h-16 md:hidden">
        <button
            @click="open = !open"
            class="p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <!-- Ícono de menú -->
                <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <!-- Ícono de cerrar -->
                <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Sidebar responsivo (solo para móviles) -->
    <div
        :class="{ 'translate-x-0': open, '-translate-x-full': !open }"
        class="absolute top-0 left-0 w-64 h-screen bg-white shadow-md transform transition-transform duration-300 z-40 md:hidden">
        <x-admin-sidebar />
    </div>

    <!-- Overlay para cerrar el menú responsivo -->
    <div
        x-show="open"
        @click="open = false"
        class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden"
        x-cloak>
    </div>
</div>
