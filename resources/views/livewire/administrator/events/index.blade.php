@extends('layouts.app')
@section('title','Eventos')
@section('content')
    <div class="col-md-12">
        @component('component.card')
            @slot('titulo')Eventos @endslot
                @livewire('events.events-component')
        @endcomponent
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{config('maps.API_KEY_GOOGLE_MAP')}}" async defer></script>
    <script type="text/javascript" src="{{asset('js/googleMaps.js')}}" async defer></script>
    <script type="text/javascript">
        window.livewire.on('saveModal', () => {
            $('#modalFormEvents').modal('hide');
        });
        window.livewire.on('initMap', (lat, lng) => {
            resetMap(lat, lng);
        });
    </script>
@endsection
