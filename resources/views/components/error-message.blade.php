@if(session('error'))
    <div class="bg-red-100
            border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert">
        <strong class="font-bold">¡Ups!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
@endif
