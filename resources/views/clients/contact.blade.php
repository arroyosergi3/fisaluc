<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Formulario de Contacto') }}
        </h2>
        <script src="https://cdn.jsdelivr.net/npm/flowbite@1.5.1/dist/flowbite.js"></script>
        @if (session('success'))
            <x-alert type="success" message="{{ session('success') }}"></x-alert>
        @endif
    </x-slot>
    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('contact.send') }}">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-300">Nombre</label>
                            <input type="text" name="name" step="0.01" class="w-full mt-1 rounded dark:bg-gray-700" placeholder="John Doe" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-300">Email</label>
                            <input type="text" name="email" step="0.01" class="w-full mt-1 rounded dark:bg-gray-700" placeholder="johndoe@hotmail.com"  required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-300">Mensaje</label>
                            <textarea name="message" class="w-full mt-1 rounded dark:bg-gray-700" placeholder="Escribe aquí tu mensaje..."></textarea>
                        </div>


                    <x-primary-button>
                        Enviar
                    </x-primary-button>
                    </form>

                </div>


            </div>
        </div>
    </div>

    <x-footer/>
</x-app-layout>
