@section('title', 'Noticias')
<div class="col-12">
    @component('component.card')
        @slot('titulo')Noticias @endslot
        <div class="row">
            <div class="col-md-12">
               @include('livewire.administrator.noticias.listaNoticias')
            </div>
        </div>
    @endcomponent
</div>
@section('scripts')
    <!-- Include Required Prerequisites -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <!-- Include Date Range Picker -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

    <script type="text/javascript">
        window.livewire.on('saveModal', () => {
            $('#modalForm').modal('hide');
        });

        $('input[name="fechaFilter"]').daterangepicker(
            {
                locale: {
                    format: 'YYYY/MM/DD',
                    separator: " - ",
                    applyLabel: "Aplicar",
                    cancelLabel: "Cancelar",
                    fromLabel: "Desde",
                    toLabel: "Hasta",
                    customRangeLabel: "Custom",
                    daysOfWeek: [
                        "Do",
                        "Lu",
                        "Ma",
                        "Mi",
                        "Ju",
                        "Vi",
                        "Sa"
                    ],
                    monthNames: [
                        "Enero",
                        "Febrero",
                        "Marzo",
                        "Abril",
                        "Mayo",
                        "Junio",
                        "Julio",
                        "Augosto",
                        "Septiembre",
                        "Octubre",
                        "Noviembre",
                        "Diciembre"
                    ],
                    firstDay: 1
                },
                opens:'left'
            },
            function(start, end, label) {
                Livewire.emit('getFechaFilter', start.format('YYYY/MM/DD')+'-'+end.format('YYYY/MM/DD'));
            });

        $('input[name="fechaNews"]').daterangepicker(
            {
                locale: {
                    format: 'YYYY/MM/DD',
                    separator: " - ",
                    applyLabel: "Aplicar",
                    cancelLabel: "Cancelar",
                    fromLabel: "Desde",
                    toLabel: "Hasta",
                    customRangeLabel: "Custom",
                    daysOfWeek: [
                        "Do",
                        "Lu",
                        "Ma",
                        "Mi",
                        "Ju",
                        "Vi",
                        "Sa"
                    ],
                    monthNames: [
                        "Enero",
                        "Febrero",
                        "Marzo",
                        "Abril",
                        "Mayo",
                        "Junio",
                        "Julio",
                        "Augosto",
                        "Septiembre",
                        "Octubre",
                        "Noviembre",
                        "Diciembre"
                    ],
                    firstDay: 1
                },
                opens:'right'
            },
            function(start, end, label) {
                Livewire.emit('getAddFecha', start.format('YYYY/MM/DD')+'-'+end.format('YYYY/MM/DD'));
            });

    </script>
@endsection
