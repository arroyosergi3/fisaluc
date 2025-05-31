<div>


    <!-- Selección de Tratamiento -->
    <label for="treat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecciona el
        tratamiento</label>
    <select wire:model.live="selectedTreatment" id="treat" name="treatment_id"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option  value="">Selecciona un tratamiento</option>
        @foreach ($treatments as $t)
            <option value="{{ $t->id }}" >{{ $t->description }}</option>
        @endforeach
    </select>
    @error('treat') <p class="text-red-600">
        {{ $message }}
    </p>
    @enderror

    <!-- Selección de Fisioterapeutas -->
    <label for="physio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-4">Selecciona el
        fisioterapeuta</label>
    <select id="physio" wire:model.live="selectedPhysio" name="physio_id"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        @if (!empty($physios))
            @foreach ($physios as $p)
                <option value="{{ $p['id'] }}">{{ $p['name'] }} {{ $p['surname'] }}</option>
            @endforeach
        @else
            <option value="">No hay fisioterapeutas disponibles</option>
        @endif
    </select>
    @error('physio') <p class="text-red-600">
        {{ $message }}
    </p>
    @enderror

    <!-- Selección de Día -->
    <div class="relative max-w-sm">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
            </svg>
        </div>
        <label for="date" class="block mb-2  mt-4 text-sm font-medium text-gray-900 dark:text-white">Selecciona el
            día</label>

        <input type="date" wire:model.live="selectedDate" id="default-datepicker" name="date"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Select date">
    </div>
    @error('date')
    <p class="text-red-600">
        {{ $message }}
    </p>
    @enderror

    <!-- Selección de Hora -->
    <label for="time" class="block mb-2 mt-4 text-sm font-medium text-gray-900 dark:text-white">Selecciona la
        hora:</label>
    <select name="time" id="time"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option value="">Seleccion una hora</option>
        @php
            $startMorning = \Carbon\Carbon::createFromTime(9, 30); // 9:30
            $endMorning = \Carbon\Carbon::createFromTime(12, 45); // 12:45

            $startAfternoon = \Carbon\Carbon::createFromTime(16, 0); // 16:00
            $endAfternoon = \Carbon\Carbon::createFromTime(19, 45); // 19:45
        @endphp
        <!-- Generar las horas de la mañana -->
        @for ($time = $startMorning; $time <= $endMorning; $time->addMinutes(45))
            @php
                $formattedTime = $time->format('H:i');
            @endphp
            @if (!in_array($formattedTime, $busyHours))
                dd($formattedTime);
                <option value="{{ $formattedTime }}">{{ $formattedTime }}</option>
            @endif
        @endfor
        <!-- Generar las horas de la tarde -->
        @for ($time = $startAfternoon; $time <= $endAfternoon; $time->addMinutes(45))
            @php
                $formattedTime = $time->format('H:i');
            @endphp
            @if (!in_array($formattedTime, $busyHours))
                <option value="{{ $formattedTime }}">{{ $formattedTime }}</option>
            @endif
        @endfor
    </select>
    @error('time') <p class="text-red-600">
        {{ $message }}
    </p>
@enderror
</div>
