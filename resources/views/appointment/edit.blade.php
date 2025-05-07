
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Tratamiento') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('appointment.update', $appointment) }}">
                    @csrf
                    @method('PUT')


                    {{-- Selector de fisioterapeuta --}}
                    <div>
                        <label for="physio_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fisioterapeuta</label>
                        <select id="physio_id" name="physio_id" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500">
                            <option value="">Selecciona un fisioterapeuta</option>
                            @foreach ($physios as $physio)
                                <option value="{{ $physio->id }}"
                                    {{ $appointment->physio->id == $physio->id ? 'selected' : '' }}>
                                    {{ $physio->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    {{-- Selector de paciente --}}

                    <div>
                        <label for="patient_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Paciente</label>
                        <select id="patient_id" name="patient_id" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500">
                            <option value="">Selecciona un paciente</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}"
                                    {{ $appointment->patient->id == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} {{ $user->surname }}
                                </option>
                            @endforeach
                        </select>
                    </div>



                    {{-- Selector de tratamiento --}}
                    <div>
                        <label for="treatment_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tratamiento</label>
                        <select id="treatment_id" name="treatment_id" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500">
                            <option value="">Selecciona un tratamiento</option>
                            @foreach ($treats as $treat)
                                <option value="{{ $treat->id }}"
                                    {{ $appointment->treatment->id == $treat->id ? 'selected' : '' }}>
                                    {{ $treat->description }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    {{-- Fecha --}}
                    <div>
                        <label for="date"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha</label>
                        <input type="date" id="date" name="date" value="{{ $appointment->date }}" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500">
                    </div>

                    {{-- Hora --}}
                    <div>
                        <label for="time"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hora</label>
                        <input type="time" value="{{ $appointment->time }}" id="time" name="time" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500">
                    </div>

                    {{-- Botón --}}



                @if ($errors->any())
                    <div class="mt-4 text-red-500">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <x-primary-button class="mt-5">
                    Actualizar
                </x-primary-button>
                </form>
            </div>
        </div>
    </div>

    <x-footer />
</x-app-layout>
