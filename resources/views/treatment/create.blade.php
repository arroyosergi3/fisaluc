<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Nuevo Tratamiento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('treatment.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="mb-4">
        <x-input-label for="description" :value="__('Descripción')" />
        <textarea id="description"
                  class="block mt-1 w-full rounded dark:bg-gray-700 border-gray-300 "
                  name="description">{{ old('description') }}</textarea>
        <x-input-error :messages="$errors->get('description')" />
    </div>

    <div class="mb-4">
        <x-input-label for="price" :value="__('Precio')" />
        <x-text-input id="price"
                      class="block mt-1 w-full"
                      type="number"
                      name="price"
                      step="0.01"
                      :value="old('price')"
                      required />
        <x-input-error :messages="$errors->get('price')" />
    </div>

    {{--  IMAGEN  --}}
  <div x-data="{ preview: null }" class="mb-4">
    <x-input-label for="pic" :value="__('Imagen')" />

    <input id="pic" type="file" name="pic" class="hidden" accept="image/*"
           @change="preview = URL.createObjectURL($event.target.files[0])" required>

    <x-input-label for="pic"
           class="inline-block px-4 py-2 mt-1 text-white bg-teal-500 rounded cursor-pointer hover:bg-teal-700">
        Seleccionar imagen
    </x-input-label>

    <!-- Vista previa -->
    <template x-if="preview">
        <img :src="preview" class="mt-2 w-32 h-32 object-cover rounded border border-gray-300 dark:border-gray-600">
    </template>

    <x-input-error :messages="$errors->get('pic')" />
</div>



    <x-primary-button>
        Guardar
    </x-primary-button>
</form>
            </div>
        </div>
    </div>

    <x-footer/>
</x-app-layout>
