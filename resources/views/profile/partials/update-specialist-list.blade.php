<section>
    @php
        // Obtener los IDs de tratamientos que ya tiene el usuario
        $existingIds = $user->specialist->pluck('treatment')->toArray();

        // Obtener las especialidades que no tiene (desde la vista)
        $availableTreatments = \App\Models\Treatment::whereNotIn('id', $existingIds)->get();
    @endphp

    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Especialista en:') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Añade tus especialidades') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    @if ($availableTreatments->count())
        <form action="{{ route('specialist.add') }}" method="POST" class="mt-4 flex  gap-2">
            @csrf

            <select name="treatment_id" id="treatment" class=" p-2 rounded w-full mb-2">
                @foreach ($availableTreatments as $treatment)
                    <option value="{{ $treatment->id }}">{{ $treatment->description }}</option>
                @endforeach
            </select>
            <input type="hidden" name="physio_id" value="{{ $user->id }}">
            <x-primary-button>Añadir Especialidad</x-primary-button>
        </form>
    @else
        <p class="mt-4 text-gray-500">Ya tienes todas las especialidades asignadas.</p>
    @endif

    @if (session('success'))
        <p class="text-green-500"> {{ session('success') }}</p>
    @endif
    <table class="text-center">
        <thead class="text-center">
            <tr>
                <th class="px-4 py-2">Mis Especialidades</th>

            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($user->specialist()->get() as $sp)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $sp->treatmentModel->description }}</td>
                    <td>
                        <form action="{{ route('specilist.destroy', $sp) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')

                            <x-danger-button class="ms-3"
                                onclick="return confirm('¿Estás seguro de eliminar esta especialidad?')">
                                <i class="fa-solid fa-trash me-2"></i> {{ __('Eliminar') }}
                            </x-danger-button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>
