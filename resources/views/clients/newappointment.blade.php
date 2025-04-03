<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pedir Cita') }}
        </h2>
        <script src="../path/to/flowbite/dist/flowbite.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-center text-teal-600 text-[2rem]">Pide tu cita</h1>

                    <form class="max-w-sm mx-auto" method="POST">

                        <!--
                        <label for="treat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecciona el tratamiento</label>
                        <select id="treat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($treats as $t)
<option value="{{ $t->id }}">{{ $t->description }}</option>
@endforeach
                        </select>
-->

                        <!-- DOS SELECT -->

                        @livewire('treatment-selector')

                        <!-- DIA -->
                        <div class="relative max-w-sm">
                            <label for="default-datepicker"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecciona el
                                día:</label>

                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input datepicker id="default-datepicker" type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Select date">
                        </div>

                        <!-- HORA -->
                        <label for="time"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecciona la hora:</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10-10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="time" id="time"
                            class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            min="09:30" max="18:00" step="2700" value="09:30" required />
                    </div>
                    <script>
                        document.getElementById("time").addEventListener("change", function() {
                            let input = this;
                            let time = input.value;
                            let [hours, minutes] = time.split(":").map(Number);
                            let startMinutes = 9 * 60 + 30;
                            let totalMinutes = hours * 60 + minutes;
                            let remainder = (totalMinutes - startMinutes) % 45;
                            if (remainder !== 0) {
                                let correctedMinutes = totalMinutes - remainder;
                                let correctedHours = Math.floor(correctedMinutes / 60);
                                let correctedMin = correctedMinutes % 60;
                                input.value = `${String(correctedHours).padStart(2, '0')}:${String(correctedMin).padStart(2, '0')}`;
                            }
                        });
                    </script>


                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-footer />


</x-app-layout>
