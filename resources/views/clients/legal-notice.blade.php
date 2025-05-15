<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Aviso Legal') }}
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
<div class="space-y-6">
    <h1 class="text-2xl font-bold">Aviso Legal</h1>

    <p>
        En cumplimiento con el deber de información recogido en el artículo 10 de la Ley 34/2002, de 11 de julio,
        de Servicios de la Sociedad de la Información y del Comercio Electrónico, a continuación se reflejan los
        siguientes datos:
    </p>

    <p>
        La empresa titular de este sitio web es <strong>Fisaluc</strong>, con domicilio en
        <strong>Avenida de la Guardia civil, 4, 14900 Lucena (Córdoba)</strong>, provista de CIF/NIF <strong>XX123456X</strong>.
        Correo electrónico de contacto: <strong>clinicafisaluc@gmail.com</strong>.
    </p>

    <h2 class="text-xl font-semibold">Usuarios</h2>
    <p>
        El acceso y/o uso de este portal atribuye la condición de USUARIO, que acepta, desde dicho acceso y/o uso,
        las Condiciones Generales de Uso aquí reflejadas. Las citadas condiciones serán de aplicación independientemente
        de las Condiciones Generales de Contratación que en su caso resulten de obligado cumplimiento.
    </p>

    <h2 class="text-xl font-semibold">Uso del portal</h2>
    <p>
        Este sitio proporciona el acceso a multitud de informaciones, servicios, programas o datos (en adelante,
        "los contenidos") en Internet pertenecientes a <strong>Fisaluc</strong> o a sus licenciantes a
        los que el USUARIO pueda tener acceso. El USUARIO asume la responsabilidad del uso del portal.
    </p>

    <h2 class="text-xl font-semibold">Protección de datos</h2>
    <p>
        <strong>Fisaluc</strong> cumple con las directrices del Reglamento General de Protección de Datos
        (UE) 2016/679 y demás normativa vigente, y vela por garantizar un correcto uso y tratamiento de los datos
        personales del usuario.
    </p>

    <h2 class="text-xl font-semibold">Propiedad intelectual e industrial</h2>
    <p>
        <strong>Fisaluc</strong> por sí o como cesionaria, es titular de todos los derechos de propiedad
        intelectual e industrial de su página web, así como de los elementos contenidos en la misma (a título enunciativo,
        imágenes, sonido, audio, vídeo, software o textos; marcas o logotipos, combinaciones de colores, estructura y diseño, etc.).
    </p>

    <h2 class="text-xl font-semibold">Responsabilidad</h2>
    <p>
        <strong>Fisaluc</strong> no se hace responsable, en ningún caso, de los daños y perjuicios de
        cualquier naturaleza que pudieran ocasionar, a título enunciativo: errores u omisiones en los contenidos,
        falta de disponibilidad del portal o la transmisión de virus o programas maliciosos o lesivos en los contenidos,
        a pesar de haber adoptado todas las medidas tecnológicas necesarias para evitarlo.
    </p>

    <h2 class="text-xl font-semibold">Modificaciones</h2>
    <p>
        <strong>Fisaluc</strong> se reserva el derecho de efectuar sin previo aviso las modificaciones
        que considere oportunas en su portal, pudiendo cambiar, suprimir o añadir tanto los contenidos y servicios
        que se presten a través de la misma como la forma en la que éstos aparezcan presentados o localizados en su portal.
    </p>

    <h2 class="text-xl font-semibold">Legislación aplicable</h2>
    <p>
        La relación entre <strong>Fisaluc</strong> y el USUARIO se regirá por la normativa española vigente
        y cualquier controversia se someterá a los Juzgados y tribunales de la ciudad de residencia del titular del sitio web.
    </p>
</div>

                </div>


            </div>
        </div>
    </div>

    <x-footer />
</x-app-layout>
