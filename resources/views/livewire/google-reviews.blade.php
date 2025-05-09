<div id="review-carousel" class="relative w-full max-w-5xl mx-auto px-10 " data-carousel="slide">
    <!-- Carrusel de Reseñas -->
    <div class="relative h-64 overflow-hidden rounded-lg">
        <div class="flex">
            <!-- Mostrar reseñas -->
            @php
                $reviewsCollection = collect($reviews);
                $chunked = $reviewsCollection->chunk(3);

                // Verifica si el último grupo tiene menos de 3
                $lastChunk = $chunked->last();
                if ($lastChunk && $lastChunk->count() < 3) {
                    $needed = 3 - $lastChunk->count();
                    $extra = $reviewsCollection->take($needed);
                    $chunked->pop(); // Elimina el último incompleto
                    $chunked->push($lastChunk->merge($extra)); // Añade el completado
                }
            @endphp

            @foreach ($chunked as $chunkIndex => $chunk)
                <div class="flex w-full duration-700 ease-in-out" data-carousel-item {{ $chunkIndex === 0 ? 'class=block' : '' }}>
                    @foreach ($chunk as $review)
                        <div class="w-1/3 px-2">
                            <article class="p-4 dark:bg-gray-400 bg-white rounded shadow-md h-full flex flex-col">
                                <!-- Contenedor del contenido alineado arriba -->
                                <div class="flex-grow-0">
                                    <div class="flex items-center mb-4">
                                        <img class="w-10 h-10 rounded-full mr-4"
                                            src="{{ $review['profile_photo_url'] ?? '/images/default-avatar.jpg' }}"
                                            alt="Foto de {{ $review['author_name'] }}">
                                        <div class="font-medium">
                                            <p class="leading-tight">{{ $review['author_name'] }}</p>
                                            <time
                                                class="block text-sm dark:text-white leading-tight">{{ $review['relative_time_description'] }}</time>
                                        </div>
                                    </div>
                                    <div class="flex items-center mb-3">
                                        @for ($i = 0; $i < 5; $i++)
                                            @if ($i < $review['rating'])
                                                <svg class="w-4 h-4 text-yellow-400" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.518 4.674h4.911c.969 0 1.371 1.24.588 1.81l-3.977 2.89 1.518 4.674c.3.921-.755 1.688-1.54 1.118L10 14.347l-3.977 2.89c-.784.57-1.838-.197-1.539-1.118l1.518-4.674-3.977-2.89c-.783-.57-.38-1.81.588-1.81h4.911L9.049 2.927z" />
                                                </svg>
                                            @else
                                                <svg class="w-4 h-4 text-gray-300" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.518 4.674h4.911c.969 0 1.371 1.24.588 1.81l-3.977 2.89 1.518 4.674c.3.921-.755 1.688-1.54 1.118L10 14.347l-3.977 2.89c-.784.57-1.838-.197-1.539-1.118l1.518-4.674-3.977-2.89c-.783-.57-.38-1.81.588-1.81h4.911L9.049 2.927z" />
                                                </svg>
                                            @endif
                                        @endfor
                                    </div>
                                    <p class="dark:text-white text-sm line-clamp-6">{{ $review['text'] }}</p>
                                </div>
                                <!-- Esto creará el espacio en blanco abajo automáticamente -->
                            </article>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>

    <!-- Controles del Carrusel - Ahora sobresalen completamente -->
    <button type="button"
        class="absolute top-1/2 -left-5 z-30 flex bg-white dark:bg-gray-400 items-center justify-center w-12 h-64 -translate-y-1/2 rounded shadow-lg "
        data-carousel-prev>
        <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
        <span class="sr-only">Anterior</span>
    </button>

    <button type="button"
        class="absolute top-1/2 -right-5 z-30 flex bg-white dark:bg-gray-400 items-center justify-center w-12 h-64 -translate-y-1/2  rounded shadow-lg  "
        data-carousel-next>
        <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
        </svg>
        <span class="sr-only">Siguiente</span>
    </button>
</div>
