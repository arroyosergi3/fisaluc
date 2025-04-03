<div>
    <!-- Selección de Tratamiento -->
    <label for="treat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecciona el tratamiento</label>
    <select wire:model.live="selectedTreatment" id="treat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option value="">Selecciona un tratamiento</option>
        @foreach ($treatments as $t)
            <option value="{{ $t->id }}">{{ $t->description }}</option>
        @endforeach
    </select>

    <!-- Selección de Fisioterapeutas -->
    <label for="physio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-4">Selecciona el fisioterapeuta</label>
    <select id="physio" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        @if (!empty($physios))
            @foreach ($physios as $p)
                <option value="{{ $p['id'] }}">{{ $p['name'] }} {{ $p['surname'] }}</option>
            @endforeach
        @else
            <option value="">No hay fisioterapeutas disponibles</option>
        @endif
    </select>





</div>
