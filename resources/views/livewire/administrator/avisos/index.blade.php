@extends('layouts.app')
@section('title','Avisos')
@section('content')
    <div class="col-md-12">
        @component('component.card')
            @slot('titulo')Avisos @endslot
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-link active" id="nav-avisos-tab" data-toggle="tab" href="#nav-avisos" role="tab" aria-controls="nav-avisos" aria-selected="true"><i class="fas fa-bullhorn"></i> Avisos</a>
                    <a class="nav-link" id="nav-category-tab" data-toggle="tab" href="#nav-category" role="tab" aria-controls="nav-category" aria-selected="false"><i class="fas fa-list"></i> Categorías</a>
                    @if (auth()->user()->rol == 'Super-Administrador')
                        <a class="nav-link" id="nav-state-tab" data-toggle="tab" href="#nav-state" role="tab" aria-controls="nav-state" aria-selected="false"><i class="fas fa-check-circle"></i> Estados</a>
                    @endif
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-avisos" role="tabpanel" aria-labelledby="nav-avisos-tab">
                    @livewire('avisos.avisos-component')
                </div>

                <div class="tab-pane fade" id="nav-category" role="tabpanel" aria-labelledby="nav-category-tab">
                    @livewire('avisos.category-sub-category-component')
                </div>
                @if (auth()->user()->rol == 'Super-Administrador')
                    <div class="tab-pane fade show" id="nav-state" role="tabpanel" aria-labelledby="nav-state-tab">
                        @livewire('avisos.states-component')
                    </div>
                @endif
            </div>
        @endcomponent
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{config('maps.API_KEY_GOOGLE_MAP')}}" async defer></script>
    <script type="text/javascript" src="{{asset('js/googleMaps.js')}}" async defer></script>

    <!-- Include Required Prerequisites -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>


    <!-- Include Date Range Picker -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

    <script type="text/javascript">
        window.livewire.on('saveModal', () => {
            $('#modalForm').modal('hide');
            $('#modalState').modal('hide');
            $('#modalFormWarning').modal('hide');
        });
        window.livewire.on('initMap', (lat, lng) => {
            resetMap(lat, lng);
        });

        window.livewire.on('showMap', (lat, lng) => {
            resetMap(lat, lng, false);
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


    </script>
@endsection
