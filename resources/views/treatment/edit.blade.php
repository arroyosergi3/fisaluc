<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Editar Tratamiento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('treatment.update', $treatment) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <x-input-label for="description" :value="__('Descripción')" />
        <textarea id="description"
                  class="block mt-1 w-full rounded dark:bg-gray-700 border-gray-300 focus:border-teal-500 focus:ring-teal-500 dark:border-gray-600 dark:focus:border-teal-500 dark:focus:ring-teal-500"
                  name="description">{{ old('description', $treatment->description) }}</textarea>
        <x-input-error :messages="$errors->get('description')" />
    </div>

    <div class="mb-4">
        <x-input-label for="price" :value="__('Precio')" />
        <x-text-input id="price"
                      class="block mt-1 w-full"
                      type="number"
                      name="price"
                      step="0.01"
                      :value="old('price', $treatment->price)"
                      required />
        <x-input-error :messages="$errors->get('price')" />
    </div>

    <div x-data="{ preview: null }" class="mb-4">
    <!-- Título del campo -->
    <x-input-label for="pic" :value="__('Imagen')" class="mb-1" />

    <!-- Input file oculto -->
    <input id="pic"
           x-ref="pic"
           type="file"
           name="pic"
           accept="image/*"
           class="hidden"
           @change="preview = URL.createObjectURL($refs.pic.files[0])" />

    <!-- Botón estilizado con x-input-label -->
    <x-input-label for="pic"
                   class="inline-block px-4 py-2 mt-1 text-white bg-teal-600 rounded cursor-pointer hover:bg-teal-700">
        Seleccionar imagen
    </x-input-label>

    <!-- Errores -->
    <x-input-error :messages="$errors->get('pic')" class="mt-2" />

    <!-- Mostrar nombre del archivo si se selecciona -->
    <template x-if="$refs.pic.files.length">
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            Archivo seleccionado: <span x-text="$refs.pic.files[0].name"></span>
        </p>
    </template>

    <!-- Vista previa -->
    <template x-if="preview">
        <img :src="preview"
             alt="Vista previa"
             class="mt-2 w-20 h-20 object-cover rounded border border-gray-300 dark:border-gray-600">
    </template>

    <!-- Imagen actual del servidor -->
    @if ($treatment->pic)
        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
            Imagen actual:
        </p>
        <img src="{{ asset('storage/' . $treatment->pic) }}"
             alt="Imagen actual"
             class="mt-2 w-20 h-20 object-cover rounded border border-gray-300 dark:border-gray-600">
    @endif
</div>


    <x-primary-button>
        Actualizar
    </x-primary-button>
</form>
            </div>
        </div>
    </div>

    <x-footer/>
</x-app-layout>
