<div class="bg-white shadow-md rounded-lg p-6 border border-gray-200">
    <h3 class="text-lg font-semibold text-gray-700">📌 Estudiante: {{ $entrega->estudiante->name }}</h3>

    <div class="mt-2">
        <p class="text-gray-600">📄 Archivo:
            <a href="{{ Storage::url($entrega->archivo) }}" target="_blank"
               class="text-blue-600 font-medium hover:underline">
                Descargar
            </a>
        </p>
        <p class="text-gray-600 mt-1">💬 Comentario: <span
                class="italic">{{ $entrega->comentario_alumno }}</span></p>
        <p class="text-gray-600 mt-1">📊 Calificación:
            <span
                class="{{ $entrega->calificacion ? 'font-semibold text-green-600' : 'text-red-500' }}">
                {{ $entrega->calificacion ?? 'Sin calificar' }}
            </span>
        </p>
    </div>

    <!-- Formulario para calificar -->
    <form wire:submit.prevent="saveSubmission" class="mt-4">
        <div class="flex flex-col gap-4">
            <label for="calificacion" class="text-gray-700 font-medium">Calificación (0-10)</label>
            <input type="number" id="calificacion"
                   class="w-20 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"
                   step="0.1" min="0" max="10"
                   wire:model="calificacion"
            >

            <div>
                @error("calificacion")
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <label for="observacion" class="text-gray-700 font-medium">Observación (opcional)</label>
            <textarea id="observacion"
                      class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"
                      rows="2"
                      wire:model="observacion"
                      placeholder="Escribe una observación"></textarea>
        </div>

        <x-primary-button type="submit" class="mt-4">Guardar</x-primary-button>
    </form>
</div>
