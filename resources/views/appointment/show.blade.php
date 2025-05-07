<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalle del Tratamiento') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold">{{ $appointment->name }}</h3>
                <p class="mt-2 text-gray-700 dark:text-gray-300">{{ $appointment->description }}</p>
                <p class="mt-4 font-semibold">Precio: ${{ number_format($appointment->price, 2) }}</p>
            </div>
        </div>
    </div>

    <x-footer/>
</x-app-layout>
