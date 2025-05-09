<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Pedir Cita') }}
        </h2>

        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-center text-teal-600 text-[2rem] mb-6">Pide tu cita</h1>

                    <form class="max-w-md mx-auto space-y-4" method="POST" action="{{ route('storedappointment') }}">
                        @csrf

                        <input type="hidden" name="createdByPhysio" value="1">
                        {{-- Selector de fisioterapeuta --}}
                        <div>
                            <label for="physio_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fisioterapeuta</label>
                            <select id="physio_id" name="physio_id" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500">
                                <option value="">Selecciona un fisioterapeuta</option>
                                @foreach ($physios as $physio)
                                    <option value="{{ $physio->id }}">{{ $physio->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Selector de paciente --}}
                        <div>
                            <label for="patient_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Paciente</label>
                            <select id="patient_id" name="patient_id" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500">
                                <option value="">Selecciona un paciente</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Selector de tratamiento --}}
                        <div>
                            <label for="treatment_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tratamiento</label>
                            <select id="treatment_id" name="treatment_id" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500">
                                <option value="">Selecciona un tratamiento</option>
                                @foreach ($treats as $treat)
                                    <option value="{{ $treat->id }}">{{ $treat->description }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Fecha --}}
                        <div>
                            <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha</label>
                            <input type="date" id="date" name="date" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500">
                        </div>

                        {{-- Hora --}}
                        <div>
                            <label for="time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hora</label>
                            <input type="time" id="time" name="time" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500">
                        </div>

                        {{-- Botón --}}
                        <div class="text-center">
                            <button type="submit"
                                class="mt-4 px-4 py-2 text-sm font-medium text-white bg-teal-500 rounded-lg hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:text-teal-500 dark:hover:text-white dark:bg-neutral-50 dark:hover:bg-teal-500 dark:focus:ring-blue-800">
                                Pedir Cita
                            </button>
                        </div>
                    </form>

                    @if ($errors->any())
                        <div class="mt-4 text-red-500">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <x-footer />
</x-app-layout>
