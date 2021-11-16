@extends('layouts.app')
@section('title','Localizaciones')
@section('content')
    <div class="col-md-12">
        @component('component.card')
            @slot('titulo')Localizaciones @endslot
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-link active" id="nav-location-tab" data-toggle="tab" href="#nav-location" role="tab" aria-controls="nav-location" aria-selected="true"><i class="fas fa-map-marker-alt"></i> Localizaciones</a>
                    <a class="nav-link" id="nav-category-tab" data-toggle="tab" href="#nav-category" role="tab" aria-controls="nav-category" aria-selected="false"><i class="fas fa-list"></i> Categorías</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-location" role="tabpanel" aria-labelledby="nav-location-tab">
                    @livewire('locations.location-component')
                </div>

                <div class="tab-pane fade" id="nav-category" role="tabpanel" aria-labelledby="nav-category-tab">
                    @livewire('locations.category-location-component')
                </div>
            </div>
        @endcomponent
    </div>
    @endsection
@section('scripts')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{config('maps.API_KEY_GOOGLE_MAP')}}" async defer></script>
    <script type="text/javascript" src="{{asset('js/googleMaps.js')}}" async defer></script>
    <script type="text/javascript">
        window.livewire.on('saveModal', () => {
            $('#modalFormLocation').modal('hide');
            $('#modalFormCategory').modal('hide');
        });
        window.livewire.on('initMap', (lat, lng) => {
            resetMap(lat, lng);
        });
    </script>
@endsection
