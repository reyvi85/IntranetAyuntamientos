@section('title', 'Gestion de Instancias')
<div class="col-12">
    @component('component.card')
        @slot('titulo')Instancias @endslot
        <div class="row">
             <div class="col-md-12">
              @include('livewire.administrator.instancias.instanciasList')
             </div>
        </div>
    @endcomponent
</div>
@section('scripts')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{config('maps.API_KEY_GOOGLE_MAP')}}" async defer></script>
    <script type="text/javascript" src="{{asset('js/googleMaps.js')}}" async defer></script>
    <script type="text/javascript">
        window.livewire.on('saveModal', () => {
            $('#modalInstancia').modal('hide');
           // resetMap(lat, lng);
        });

        window.livewire.on('initMap', (lat, lng) => {
            console.log('Latitud = '+lat +" Longitud = "+lng);
            resetMap(lat, lng);
        });
    </script>
@endsection
