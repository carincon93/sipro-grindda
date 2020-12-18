@component('mail::message')
Hola,

Tienes un proyecto que no ha sido enviado a evaluación, recuerda que hasta hoy es el plazo para enviar proyectos formulados a evaluación. Mira en tu panel de proyectos y desplega la lista de acciones en la opción "acciones", luego da click en "Enviar a evaluación"

<img src="{{ asset('images/recordatorio-vencimiento.png') }}" alt="" style="display:block; margin: auto;">

@component('mail::button', ['url' => route('proyectos.index'), 'color' => 'blue'])
Mis proyectos
@endcomponent


Gracias, estaremos esperando!<br>
{{ config('app.name') }}

@component('mail::subcopy')
@lang(
    "Si tienes problemas al dar click en el botón \":actionText\", copie y pegue la siguiente URL \n".
    'en el navegador web: [:actionURL](:actionURL)',
    [
        'actionText' => 'Mis proyectos',
        'actionURL' => route('proyectos.index')
    ]
)
@endcomponent

@endcomponent
