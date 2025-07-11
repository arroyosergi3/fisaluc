<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Clínica Fisaluc') }}
        </h2>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">


    </x-slot>




    <!-- CARRUSEL FOTOS -->
    <div class="w-100 ">
        <div id="indicators-carousel" class="relative w-full" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative h-[24rem] md:h-[42rem] overflow-hidden rounded-lg">
                <!-- Item 1 -->
                <div class="hidden duration-700  ease-in-out object-cover absolute   " data-carousel-item="active">
                    <img src="{{ asset('car_img_1.jpg') }}"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 bottom-0 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-700  ease-in-out object-cover   " data-carousel-item>
                    <img src="{{ asset('car_img_2_sin_recortar.jpg') }}"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 bottom-0 left-1/2" alt="...">
                </div>
                <!-- Item 3 -->
                <div class="hidden duration-700  ease-in-out object-cover   " data-carousel-item>
                    <img src="{{ asset('car_img_3.jpg') }}"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 4 -->
                <div class="hidden duration-700  ease-in-out object-cover   " data-carousel-item>
                    <img src="{{ asset('car_img_4.jpg') }}"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 5 -->
                <div class="hidden duration-700  ease-in-out object-cover   " data-carousel-item>
                    <img src="{{ asset('car_img_5.jpg') }}"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
            </div>
            <!-- Slider indicators -->
            <!-- Slider indicators -->
            <div class="absolute z-30 flex -translate-x-1/2 space-x-3 rtl:space-x-reverse bottom-5 left-1/2">
                <button type="button" class="w-3 h-3 rounded-full bg-white/70 dark:bg-gray-700" aria-current="true"
                    aria-label="Slide 1" data-carousel-slide-to="0"></button>
                <button type="button" class="w-3 h-3 rounded-full bg-white/50 dark:bg-gray-700" aria-label="Slide 2"
                    data-carousel-slide-to="1"></button>
                <button type="button" class="w-3 h-3 rounded-full bg-white/50 dark:bg-gray-700" aria-label="Slide 3"
                    data-carousel-slide-to="2"></button>
                <button type="button" class="w-3 h-3 rounded-full bg-white/50 dark:bg-gray-700" aria-label="Slide 4"
                    data-carousel-slide-to="3"></button>
                <button type="button" class="w-3 h-3 rounded-full bg-white/50 dark:bg-gray-700" aria-label="Slide 5"
                    data-carousel-slide-to="4"></button>
            </div>

            <!-- Slider controls -->
            <button type="button"
                class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-prev>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 1 1 5l4 4" />
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button"
                class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-next>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>
    </div>


    <!-- DIV CONTENEDOR -->
    <div class="pt-12 min-h-screen">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('sucess'))
                <x-alert type="success" message="{{ session('sucess') }}" />
            @endif
            @if (session('error'))
                <x-alert type="error" message="{{ session('error') }}" />
            @endif
            <div class=" dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 rounded">
                    @livewire('GoogleReviews')
                    @if (session('adminerror'))
                        <x-alert type="error" message="{{ session('adminerror') }}" />
                    @endif
                    


                {{--  SOBRE NOSOTROS --}}
                <div
                    class="flex flex-col md:flex-row items-center md:items-start md:space-x-8 p-6  dark:bg-gray-800 text-gray-900 dark:text-gray-100">
                    <!-- Imagen -->
                    <div class="w-full md:w-1/2 mb-6 md:mb-0">
                        <img src="{{ asset('fisios.png') }}" alt="Fisios de Fisaluc"
                            class="rounded-xl shadow-lg mx-auto">
                    </div>

                    <!-- Texto -->
                    <div class="w-full md:w-1/2 text-center md:text-left">
                        <p class="text-sm uppercase tracking-wide text-teal-500 dark:text-teal-300 mb-2">Sobre Nosotros
                        </p>
                        <h2 class="text-2xl md:text-3xl font-semibold mb-4">Somos más que fisaluc</h2>
                        <p class="text-base leading-relaxed">
                            Después de años de estudio y práctica, Miriam y Alejandro decidieron que era el momento de dar
                            el siguiente paso en sus carreras. Compartían una visión clara: crear un espacio donde los
                            pacientes no solo encontraran alivio a sus dolencias, sino que también recibieran un trato
                            cálido y personalizado.
                        </p>
                        <br>
                        <p class="text-base leading-relaxed">
                            Con esfuerzo y dedicación, comenzaron a planear su clínica desde cero. Buscaron el local
                            perfecto, diseñaron cada detalle para que transmitiera confianza y bienestar, y reunieron un
                            equipo comprometido con su filosofía de trabajo. No fue fácil al principio, pero su pasión y
                            determinación los impulsaron a superar cada obstáculo. </p>

                        <br>
                        <p class="text-base leading-relaxed">
                            Hoy, su clínica es un referente en la comunidad, conocida por su atención cercana y sus
                            innovadoras técnicas de rehabilitación. Lo que empezó como un sueño se convirtió en una
                            realidad gracias a su esfuerzo y amor por su profesión. </p>
                    </div>
                </div>

                {{--  DONDE NOS ENCONTRAMOS --}}
                <div class="  max-w-7xl mx-auto sm:px-6 lg:px-8 mb-12">
                    <div class=" dark:bg-gray-800 overflow-hidden  sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h2 class="text-2xl font-semibold mb-4 text-center text-teal-600 dark:text-teal-300">
                                ¿Dónde nos encontramos?
                            </h2>
                            <div class="w-full h-96 rounded-lg overflow-hidden shadow-lg">
                                <iframe class="w-full h-full border-0" style="filter: invert(0%) hue-rotate(0deg);"
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3169.318204084719!2d-4.4931533!3d37.4059531!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd6d71c0db6a6e9d%3A0xe992f5902687e959!2sCl%C3%ADnica%20Fisioterapia%20Lucena%20%7C%20Fisaluc!5e0!3m2!1ses!2ses!4v1747124203339!5m2!1ses!2ses"
                                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>





                @if (session('show_modal') && Auth::user()->google_access_token)
                    @php
                        $appointment = session('appointment');
                    @endphp

                    <x-modal show="true" name="appointment-confirmation">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <div
                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Cita pedida correctamente
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    @click="$dispatch('close-modal', 'appointment-confirmation')">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Cerrar modal</span>
                                </button>
                            </div>
                            <div class="p-4 md:p-5 space-y-4">
                                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                    ¿Desea añadir la cita a su calendario?
                                </p>
                            </div>
                            <div
                                class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <form id="add-to-calendar-form"
                                    action="{{ route('addToCalendar', ['appointment_id' => $appointment->id]) }}"
                                    method="POST" class="flex space-x-2 me-2">
                                    @csrf
                                    <x-primary-button>Añadir</x-primary-button>
                                </form>
                                <x-secondary-button @click="$dispatch('close-modal', 'appointment-confirmation')">
                                    Cancelar
                                </x-secondary-button>
                            </div>
                        </div>
                    </x-modal>
                @endif



                {{-- **NUEVA LÓGICA PARA MOSTRAR EL MODAL** --}}
                @auth
                    @if (empty(auth()->user()->phone) || empty(auth()->user()->birthday))
                        <x-modal show="true" name="complete-user-data">
                            <div class="flex  items-center justify-center ">
                                <div class="relative bg-white dark:bg-gray-600 rounded-lg shadow-xl w-full "
                                    @click.away.stop>
                                    <div
                                        class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-500">
                                        <h2 class="text-xl font-semibold text-teal-500">Completa tus datos</h2>
                                    </div>
                                    <form method="POST" action="{{ route('google.storeMissing') }}"
                                        class="p-4 space-y-4">
                                        @csrf

                                        <div>
                                            <x-input-label for="phone" :value="__('Teléfono')" />
                                            <x-text-input id="phone" class="block mt-1 w-full" name="phone"
                                                :value="old('phone', auth()->user()->phone)" :readonly="auth()->user()->phone ? true : false" :required="!auth()->user()->phone" autocomplete="tel" />
                                            <x-input-error :messages="$errors->get('phone')" />
                                        </div>

                                        <div>
                                            <x-input-label for="birthdate" :value="__('Fecha de nacimiento')" />
                                            <x-text-input id="birthdate" class="block mt-1 w-full" type="date"
                                                name="birthdate" :value="old('birthdate', auth()->user()->birthday)" :readonly="auth()->user()->birthday ? true : false" :required="!auth()->user()->birthday" />
                                            <x-input-error :messages="$errors->get('birthdate')" />
                                        </div>
                                        <x-primary-button>Guardar</x-primary-button>
                                    </form>
                                </div>
                            </div>
                        </x-modal>
                    @endif
                @endauth

            </div>
        </div>
    </div>
    <x-footer />
    @include('cookie-consent::index')
</x-app-layout>
