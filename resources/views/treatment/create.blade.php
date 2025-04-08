<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Nuevo Tratamiento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('treatment.store') }}" enctype="multipart/form-data">
                    @csrf


                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300">Descripción</label>
                        <textarea name="description" class="w-full mt-1 rounded"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300">Precio</label>
                        <input type="number" name="price" step="0.01" class="w-full mt-1 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300">Imagen</label>
                        <input type="file" name="pic" step="0.01" class="w-full mt-1 rounded" required>
                    </div>

                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Guardar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <x-footer/>
</x-app-layout>
