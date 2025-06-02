<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Tratamientos') }}
        </h2>

    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if ($treats->isEmpty())
                    <p class="text-center text-gray-500">No hay tratamientos disponibles.</p>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($treats as $treat)
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">

                                    <img class="w-full h-48 object-cover rounded-t-lg" src="{{ asset('storage/' . $treat->pic) }}" alt="{{ $treat->description }}" />

                                <div class="p-5">
                                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                            {{ $treat->description }}
                                        </h5>
                                    <a href="{{ route('newappointment', ['id_treat' => $treat->id]) }}">
                                        <x-primary-button> Pedir cita
                                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                        </svg> </x-primary-button>

                                    </a>
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
