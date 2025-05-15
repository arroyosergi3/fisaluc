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
                            <x-input-label for="name" :value="__('Nombre')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name')" placeholder="John Doe" required />
                            <x-input-error :messages="$errors->get('name')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" placeholder="johndoe@hotmail.com" required />
                            <x-input-error :messages="$errors->get('email')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="message" :value="__('Mensaje')" />
                            <textarea id="message"
                                class="block mt-1 w-full rounded dark:bg-gray-900 border-gray-300 focus:border-teal-500 focus:ring-teal-500 dark:border-gray-600 dark:focus:border-teal-500 dark:focus:ring-teal-500"
                                name="message" placeholder="Escribe aquí tu mensaje...">{{ old('message') }}</textarea>
                            <x-input-error :messages="$errors->get('message')" />
                        </div>

                        <x-primary-button>
                            Enviar
                        </x-primary-button>
                    </form>
                </div>


            </div>
        </div>
    </div>

    <x-footer />
</x-app-layout>
