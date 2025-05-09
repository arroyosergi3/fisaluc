<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Pedir Cita') }}
        </h2>
        <script src="../path/to/flowbite/dist/flowbite.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-center text-teal-600 text-[2rem]">Pide tu cita</h1>

                    <form class="max-w-sm mx-auto" method="POST" action="{{ route('storedappointment') }}">
                        @csrf
                        {{-- Formulario con Livewire --}}
                        @livewire('treatment-selector')
                    <button type="submit" class=" mt-4  px-3 py-2 text-sm font-medium text-white bg-teal-500 rounded-lg hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:text-teal-500  dark:hover:text-white dark:bg-neutral-50 dark:hover:bg-teal-500 dark:focus:ring-blue-800" > Pedir Cita </button>
                    </form>
                    @if ($errors->any())

@endif


                </div>
            </div>
        </div>
    </div>

    <x-footer />


</x-app-layout>
