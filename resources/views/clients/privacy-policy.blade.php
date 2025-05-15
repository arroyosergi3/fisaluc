<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Política de Privacidad') }}
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
    <h1 class="text-2xl font-bold">Política de Privacidad</h1>

    <p>
        En cumplimiento de lo dispuesto en el Reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo, de 27 de abril de 2016,
        relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos personales y a la libre
        circulación de estos datos (RGPD), así como en la Ley Orgánica 3/2018, de 5 de diciembre, de Protección de Datos Personales
        y garantía de los derechos digitales, <strong>Fisaluc</strong> informa a los usuarios de este sitio web sobre el tratamiento que se hace de sus datos personales.
    </p>

    <h2 class="text-xl font-semibold">Responsable del tratamiento</h2>
    <p>
        - Razón Social: <strong>Fisaluc</strong><br>
        - CIF/NIF: <strong>XX123456X</strong><br>
        - Dirección: <strong>Avenida de la Guardia civil, 4, 14900 Lucena (Córdoba)</strong><br>
        - Email de contacto: <strong>clinicafisaluc@gmail.com</strong>
    </p>

    <h2 class="text-xl font-semibold">Finalidad del tratamiento de los datos</h2>
    <p>
        Los datos personales recabados a través del sitio web serán tratados con las siguientes finalidades:
    </p>
    <ul class="list-disc list-inside">
        <li>Atender las consultas y solicitudes realizadas a través del formulario de contacto.</li>
        <li>Gestionar la relación comercial o contractual que pueda derivarse.</li>
        <li>Enviar información comercial y promocional relacionada con nuestros productos y servicios, si el usuario lo consiente.</li>
    </ul>

    <h2 class="text-xl font-semibold">Legitimación para el tratamiento</h2>
    <p>
        El tratamiento de sus datos personales se basa en el consentimiento otorgado por el interesado, que podrá ser retirado
        en cualquier momento. En caso de contratación de servicios, la base legal será la ejecución de un contrato.
    </p>

    <h2 class="text-xl font-semibold">Conservación de los datos</h2>
    <p>
        Los datos personales proporcionados se conservarán mientras se mantenga la relación con el usuario o no se solicite
        su supresión, y durante el plazo legal en que puedan derivarse responsabilidades legales.
    </p>

    <h2 class="text-xl font-semibold">Comunicación de datos a terceros</h2>
    <p>
        No se cederán datos a terceros, salvo obligación legal o en el caso de que sea necesario para la prestación del servicio solicitado.
    </p>

    <h2 class="text-xl font-semibold">Derechos del usuario</h2>
    <p>
        El usuario tiene derecho a:
    </p>
    <ul class="list-disc list-inside">
        <li>Acceder a sus datos personales.</li>
        <li>Solicitar la rectificación de los datos inexactos.</li>
        <li>Solicitar su supresión cuando, entre otros motivos, los datos ya no sean necesarios para los fines que fueron recogidos.</li>
        <li>Oponerse al tratamiento de sus datos.</li>
        <li>Solicitar la limitación del tratamiento de sus datos.</li>
        <li>Solicitar la portabilidad de sus datos.</li>
    </ul>
    <p>
        Para ejercer estos derechos puede dirigirse por escrito al correo <strong>clinicafisaluc@gmail.com</strong>, adjuntando copia de su DNI o documento identificativo equivalente.
    </p>

    <h2 class="text-xl font-semibold">Medidas de seguridad</h2>
    <p>
        <strong>Fisaluc</strong> adopta las medidas técnicas y organizativas necesarias para garantizar la seguridad
        de los datos de carácter personal y evitar su alteración, pérdida, tratamiento o acceso no autorizado.
    </p>

    <h2 class="text-xl font-semibold">Cambios en esta política</h2>
    <p>
        <strong>Fisaluc</strong> se reserva el derecho a modificar esta política para adaptarla a novedades legislativas
        o jurisprudenciales. En dichos supuestos, se anunciarán en esta página los cambios introducidos con antelación razonable a su puesta en práctica.
    </p>
</div>


                </div>


            </div>
        </div>
    </div>

    <x-footer />
</x-app-layout>
