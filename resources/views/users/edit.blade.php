
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
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
                        <label class="block text-gray-700 dark:text-gray-300">Nombre</label>
                        <input type="text" name="name"  value="{{ $u->name }}" class="w-full mt-1 rounded"/>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300">Apellido</label>
                        <input type="text" name="surname" step="0.01" value="{{ $u->surname }}" class="w-full mt-1 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300">Email</label>
                        <input type="text" name="email" step="0.01" value="{{ $u->email }}" class="w-full mt-1 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300">Número de Teléfono</label>
                        <input type="text" name="phone" step="0.01"  value="{{ $u->phone }}" class="w-full mt-1 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300">Fecha de nacimiento</label>
                        <input type="date" name="birthday" step="0.01" value="{{ $u->birthday }}" class="w-full mt-1 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300">Rol</label>
                        <select  name="role" step="0.01"  class="w-full mt-1 rounded" required>
                            <option value="basic" {{ $u->role == 'basic' ? "selected" : ""  }}>Usuario</option>
                            <option value="physio" {{ $u->role == 'physio' ? "selected" : ""  }}>Fisioterapeuta</option>
                            <option value="admin" {{ $u->role == 'admin' ? "selected" : "" }}>Administrador</option>
                        </select>
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
