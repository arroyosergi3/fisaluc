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
                        <br>
                        {{-- Checkbox de política de privacidad --}}

     {{-- Checkbox de política de privacidad --}}
     {{-- Campo oculto para garantizar que siempre llegue un valor --}}

    <div class="flex items-center mb-6">
        <input id="privacy_policy" type="checkbox" name="privacy_policy" value="1" {{ old('privacy_policy') ? 'checked' : '' }} required
               class="w-4 h-4 text-teal-600 bg-gray-100 border-gray-300 rounded focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
        <x-input-label for="privacy_policy" :value="__('He leído y acepto la política de privacidad')" class="ml-2" />
        <x-input-error :messages="$errors->get('privacy_policy')"  />
    </div>
                        <x-primary-button>Pedir Cita</x-primary-button>
                        </form>



                </div>
            </div>
        </div>
    </div>

    <x-footer />


</x-app-layout>
