@php
    use Carbon\Carbon;
@endphp

<x-app-layout>
    <x-slot name="header" >
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Mis Citas') }}
        </h2>
    </x-slot>



    <div class="py-2 min-h-screen ">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('deleteSuccess'))
            <x-alert type="success" message="{{ session('deleteSuccess') }}"></x-alert>
        @endif
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if ($ma->isEmpty())
                    <p class="text-center text-gray-500">No tienes citas programadas.</p>
                @else
                    <div class="flex flex-wrap justify- gap-8 ">
                        @foreach ($ma as $a)
                        <div class="w-96 p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                            <div class="flex flex-col space-y-4">
                                <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Día: {{ Carbon::parse($a->date)->format('d-m-Y') }}</h5>
                                <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Hora: {{ Carbon::parse($a->time)->format('H:i') }}</h5>
                                <p class="font-normal text-gray-700 dark:text-gray-400">Tratamiento: {{ $a->treatment->description }}</p>

                                <form action="{{ route('destroyForPatient', $a) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button class="ms-3" onclick="return confirm('¿Estás seguro de eliminar esta cita?')">
                                        <i class="fa-solid fa-trash me-2"></i> {{ __('Anular Cita') }}
                                    </x-danger-button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                    </div>
                @endif

            </div>
        </div>
    </div>

    <x-footer/>
</x-app-layout>
