<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mis Citas') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">


                @if ($ma->isEmpty())
                    <p class="text-center text-gray-500">No hay tratamientos disponibles.</p>
                @else
                    @foreach ($ma as $a)

                    <p class="text-center text-gray-500">Dia: {{ $a->date }}</p>
                    <p class="text-center text-gray-500">Hora: {{ $a->time }}</p>
                    <p class="text-center text-gray-500">Tratamiento: {{ $a->treatment->description }}</p>
                    <p class="text-center text-gray-500">Fisio: {{ $a->physio->name }}</p>
                <br>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <x-footer/>
</x-app-layout>
