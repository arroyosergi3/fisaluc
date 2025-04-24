<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tratamientos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if (session('createSuccess'))
            <x-alert type="success" message="{{ session('createSuccess') }}"></x-alert>
        @endif
        @if (session('createError'))
            <x-alert type="error" message="{{ session('createError') }}"></x-alert>
        @endif
        @if (session('updateSuccess'))
            <x-alert type="success" message="{{ session('updateSuccess') }}"></x-alert>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 dark:text-white">


            <div class="mb-4 ">
                <a href="{{ route('treatment.create') }}"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-teal-500 rounded-lg hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:text-teal-500  dark:hover:text-white dark:bg-neutral-50 dark:hover:bg-teal-500 dark:focus:ring-blue-800">
                    Nuevo Usuario
                </a>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if (session('success'))
                    <div class="text-green-500 mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="min-w-full text-center">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2">Apellidos</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Número de teléfono</th>
                            <th class="px-4 py-2">Fecha Nacimiento</th>
                            <th class="px-4 py-2">Rol</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (empty($users))
                        No hay tratamientos para mostrar
                        @endif
                        @foreach ($users as $u)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $u->name }}</td>
                                <td class="px-4 py-2">{{ $u->surname }}</td>
                                <td class="px-4 py-2">{{ $u->email }}</td>
                                <td class="px-4 py-2">{{ $u->phone }}</td>
                                <td class="px-4 py-2">{{ $u->birthday }}</td>
                                <td class="px-4 py-2">{{ $u->role }}</td>
                                <td class="px-4 py-2 space-x-2">
                                    <a href="{{ route('users.edit', $u->id) }}"><x-primary-button><i class="fa-solid fa-pen-to-square me-2"></i> {{ __('Editar') }} </x-primary-button></a>

                                    <form action="{{ route('users.destroy', $u) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button class="ms-3"
                                            onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                            <i class="fa-solid fa-trash me-2"></i> {{ __(' Eliminar') }}
                                        </x-danger-button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <x-footer />
</x-app-layout>
