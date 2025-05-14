
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Editar Tratamiento') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('users.update', $u) }}">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <x-input-label for="name" :value="__('Nombre')" />
        <x-text-input id="name"
                      class="block mt-1 w-full"
                      type="text"
                      name="name"
                      :value="old('name', $u->name)" />
        <x-input-error :messages="$errors->get('name')" />
    </div>

    <div class="mb-4">
        <x-input-label for="surname" :value="__('Apellido')" />
        <x-text-input id="surname"
                      class="block mt-1 w-full"
                      type="text"
                      name="surname"
                      :value="old('surname', $u->surname)"
                      required />
        <x-input-error :messages="$errors->get('surname')" />
    </div>

    <div class="mb-4">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email"
                      class="block mt-1 w-full"
                      type="email"
                      name="email"
                      :value="old('email', $u->email)"
                      required />
        <x-input-error :messages="$errors->get('email')" />
    </div>

    <div class="mb-4">
        <x-input-label for="phone" :value="__('Número de Teléfono')" />
        <x-text-input id="phone"
                      class="block mt-1 w-full"
                      type="text"
                      name="phone"
                      :value="old('phone', $u->phone)"
                      required />
        <x-input-error :messages="$errors->get('phone')" />
    </div>

    <div class="mb-4">
        <x-input-label for="birthday" :value="__('Fecha de nacimiento')" />
        <x-text-input id="birthday"
                      class="block mt-1 w-full"
                      type="date"
                      name="birthday"
                      :value="old('birthday', $u->birthday)"
                      required />
        <x-input-error :messages="$errors->get('birthday')" />
    </div>

    <div class="mb-4">
        <x-input-label for="role" :value="__('Rol')" />
        <select id="role" name="role" class="block mt-1 w-full rounded border-gray-300 " required>
            <option value="basic" {{ old('role', $u->role) == 'basic' ? 'selected' : '' }}>Usuario</option>
            <option value="physio" {{ old('role', $u->role) == 'physio' ? 'selected' : '' }}>Fisioterapeuta</option>
            <option value="admin" {{ old('role', $u->role) == 'admin' ? 'selected' : '' }}>Administrador</option>
        </select>
        <x-input-error :messages="$errors->get('role')" />
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
