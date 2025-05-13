<div id="review-carousel" class="relative w-full max-w-7xl mx-auto px-6" data-carousel="static">
    <!-- Carrusel de Reseñas -->
    <div class="relative h-64 overflow-hidden rounded-lg">
        <div class="flex flex-wrap justify-center gap-2">
            <!-- Mostrar reseñas -->
            @foreach ($reviews as $index => $review)
                <div class="w-full sm:w-1/2  duration-700 ease-in-out flex justify-center" data-carousel-item {{ $index === 0 ? 'class=block' : '' }}>
                    <div class="w-full px-10 flex justify-center">
                        <article class="p-6 dark:bg-gray-400 bg-white rounded shadow-md h-full flex flex-col max-w-[500px]"> <!-- Aumenté max-w -->
                            <div class="flex-grow-0">
                                <div class="flex items-center mb-4">
                                    <img class="w-10 h-10 rounded-full mr-4" src="{{ $review['profile_photo_url'] ?? '/images/default-avatar.jpg' }}" alt="Foto de {{ $review['author_name'] }}">
                                    <div class="font-medium">
                                        <p class="leading-tight">{{ $review['author_name'] }}</p>
                                        <time class="block text-sm dark:text-white leading-tight">{{ $review['relative_time_description'] }}</time>
                                    </div>
                                </div>
                                <div class="flex items-center mb-3">
                                    @for ($i = 0; $i < 5; $i++)
                                        <svg class="w-4 h-4 {{ $i < $review['rating'] ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.518 4.674h4.911c.969 0 1.371 1.24.588 1.81l-3.977 2.89 1.518 4.674c.3.921-.755 1.688-1.54 1.118L10 14.347l-3.977 2.89c-.784.57-1.838-.197-1.539-1.118l1.518-4.674-3.977-2.89c-.783-.57-.38-1.81.588-1.81h4.911L9.049 2.927z" />
                                        </svg>
                                    @endfor
                                </div>
                                <p class="dark:text-white text-sm line-clamp-6">{{ $review['text'] }}</p>
                            </div>
                        </article>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Controles del Carrusel -->
    <button type="button" class="bg-teal-500 absolute top-1/2 -left-1 z-30 flex  dark:bg-gray-400 items-center justify-center w-12 h-64 -translate-y-1/2 rounded shadow-lg" data-carousel-prev>
        <svg class="w-6 h-6 text-gray-800" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
        <span class="sr-only">Anterior</span>
    </button>

    <button type="button" class="absolute top-1/2 -right-1 z-30 flex bg-teal-500 dark:bg-gray-400 items-center justify-center w-12 h-64 -translate-y-1/2 rounded shadow-lg" data-carousel-next>
        <svg class="w-6 h-6 text-gray-800" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
        </svg>
        <span class="sr-only">Siguiente</span>
    </button>
</div>
