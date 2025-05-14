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
                            <x-input-label for="physio_id" :value="__('Fisioterapeuta')" />
                            <select id="physio_id" name="physio_id" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500">
                                <option value="">Selecciona un fisioterapeuta</option>
                               @foreach ($physios as $physio)
    <option value="{{ $physio->id }}" {{ old('physio_id') == $physio->id ? 'selected' : '' }}>
        {{ $physio->name  }} {{ $physio->surname  }}
    </option>
@endforeach

                            </select>
                            <x-input-error :messages="$errors->get('physio_id')" />
                        </div>

                        {{-- Selector de paciente --}}
                        <div>
                            <x-input-label for="patient_id" :value="__('Paciente')" />
                            <select id="patient_id" name="patient_id" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500">
                                <option value="">Selecciona un paciente</option>
                                @foreach ($users as $user)
    <option value="{{ $user->id }}" {{ old('patient_id') == $user->id ? 'selected' : '' }}>
        {{ $user->name }} {{ $user->surname }}
    </option>
@endforeach

                            </select>
                            <x-input-error :messages="$errors->get('patient_id')" />
                        </div>

                        {{-- Selector de tratamiento --}}
                        <div>
                            <x-input-label for="treatment_id" :value="__('Tratamiento')" />
                            <select id="treatment_id" name="treatment_id" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500">
                                <option value="">Selecciona un tratamiento</option>
                                @foreach ($treats as $treat)
    <option value="{{ $treat->id }}" {{ old('treatment_id') == $treat->id ? 'selected' : '' }}>
        {{ $treat->description }}
    </option>
@endforeach

                            </select>
                            <x-input-error :messages="$errors->get('treatment_id')" />
                        </div>

                        {{-- Fecha --}}
                        <div>
                            <x-input-label for="date" :value="__('Fecha')" />
                            <x-text-input id="date" class="block mt-1 w-full" type="date" name="date"
                                :value="old('date')" required />
                            <x-input-error :messages="$errors->get('date')" />
                        </div>

                        {{-- Hora --}}
                        <div>
                            <x-input-label for="time" :value="__('Hora')" />
                            <x-text-input id="time" class="block mt-1 w-full" type="time" name="time"
                                :value="old('time')" required />
                            <x-input-error :messages="$errors->get('time')" />
                        </div>

                        {{-- Botón --}}
                        <x-primary-button>Pedir Cita</x-primary-button>
                    </form>


                </div>
            </div>
        </div>
    </div>

    <x-footer />
</x-app-layout>
