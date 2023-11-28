<style>
    .fc-event, .fc-event-dot {
        background-image: linear-gradient(195deg, #EC407A 0%, #D81B60 100%);
}
.fc-event {
    border: 1px solid #D81B60!important;
}
.fc-unthemed td.fc-today {
    background: #FFD1F5!important;
}
</style>


@extends('layout.template')

@section('content')
<div class="container-fluid py-4">
    <!-- Aquí colocas el código del calendario -->
    <p style="font-size: 24pt; color:#344767;">Calendario de <strong>Citas</strong>, <strong>Consultas</strong> y <strong>Cirugias</strong></p>
    <div style="background: #ffffff; border-radius: 20px">
        <div id='calendar' style="margin: auto; padding: 30px"></div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var SITEURL = "{{ url('/') }}";
        var userId = {{ Auth::user()->id }}; // Asumiendo que aquí obtienes el ID del usuario en tu plantilla de Blade

        $.ajax({
            url: SITEURL + "/get-events/" + userId,
            method: "GET",
            success: function (data) {
                var events = [];
                data.forEach(function (event) {
                    console.log(event)
                    var dateTime = event.start_date + 'T' + event.time; // Combina fecha y hora
                    events.push({
                    title: event.title,
                    start: dateTime, // Utiliza la fecha y hora combinadas
                    description: event.description, // Agregar descripción como propiedad adicional
                    estatus: event.estatus // Agregar estatus como propiedad adicional
                    });
                });

                $('#calendar').fullCalendar({
                    // Opciones del calendario...
                    locale: 'es',
                    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
                    monthNames: [
                        'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                    ],
                    monthNamesShort: [
                        'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
                        'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'
                    ],
                    events: events,
                    eventRender: function (event, element) {
                        var content =
                        '<div class="event-info">' +
                            '<h3>' + event.title + '</h3>' +
                            '<p><strong>Fecha:</strong> ' + moment(event.start).format('YYYY-MM-DD') + '</p>' +
                            '<p><strong>Hora:</strong> ' + moment(event.start).format('HH:mm') + '</p>' + // Mostrar la hora del evento
                            '<p><strong>Descripción:</strong> ' + event.description + '</p>' +
                            '<p><strong>Estatus:</strong> ' + event.estatus + '</p>' + // Mostrar estatus
                        '</div>';
                            
                        element.popover({
                            title: event.title,
                            content: content,
                            trigger: 'hover',
                            placement: 'top',
                            container: 'body',
                            html: true
                        });
                    },
                    eventClick: function (event) {
                        alert('Descripción: ' + event.description); // Mostrar descripción al hacer clic en el evento
                    }
                });
            },
            error: function (error) {
                console.log(error);
            }
        });
    });
</script>
@endsection
