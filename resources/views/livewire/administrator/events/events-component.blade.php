<div class="mt-4">
    @include('component.loading')
    <div class="form-row">
        <div class="form-group col-md-{{(auth()->user()->rol =='Super-Administrador')?4:7}}">
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Buscar" wire:model="search">
        </div>

        @if (auth()->user()->rol =='Super-Administrador')
            <div class="form-group col-md-3">
                @php($label = false)
                @php($ModelName = 'instancias')
                @include('livewire.partial.comboInstancias')

            </div>
        @endif

        @if ($listCategory->count())
            <div class="form-group col-md-3">
                <select class="form-control" wire:model="categoryFilter">
                    <option value="">-- Categorías --</option>
                    @foreach($listCategory as $ctg)
                        <option value="{{$ctg->id}}">{{$ctg->name}}</option>
                    @endforeach
                </select>
            </div>
        @endif


        <div class="form-group col-md-2">
            <a class="btn btn-primary btn-block" role="button" data-toggle="modal" data-target="#modalFormEvents" wire:click="add"><i class="fas fa-plus-circle"></i> Añadir</a>
        </div>
    </div>
    @include('livewire.administrator.events.lista-events')
    @include('livewire.administrator.events.formModalEvents')
</div>
@section('scripts')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{config('maps.API_KEY_GOOGLE_MAP')}}" async defer></script>
    <script type="text/javascript" src="{{asset('js/googleMaps.js')}}" async defer></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
        window.livewire.on('saveModal', () => {
            $('#modalFormEvents').modal('hide');
            $('#modalFormCategory').modal('hide');
        });
        window.livewire.on('initMap', (lat, lng) => {
            resetMap(lat, lng);
        });

        $('#fecha_inicio').datepicker({
            format: 'yyyy-mm-dd'
        });
        $('#fecha_fin').datepicker({
            format: 'yyyy-mm-dd'
        });
    </script>
@endsection
