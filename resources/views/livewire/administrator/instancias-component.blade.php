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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCKiIqCdZGrVxx06LSbe7uG3zXOq1Cz5k&callback=initMap" async defer></script>
    <script type="text/javascript">

        var map;
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 43.5293, lng: -5.6773},
                zoom: 13,
            });
            var marker = new google.maps.Marker({
                position: {lat: 43.542194, lng: -5.676875},
                map: map,
                title: 'Acuario de Gijón'
            });
        }


        window.livewire.on('saveModal', () => {
            $('#modalInstancia').modal('hide');
        });
    </script>
@endsection
