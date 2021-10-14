@section('title', 'Categorías de Negocios')
<div class="col-12">
@component('component.card')
    @slot('titulo')Categorías de Negocios @endslot
    <div class="row">
        <div class="col-md-12">
            @include('livewire.administrator.business.listCategory')
        </div>
    </div>
    @endcomponent
    </div>
@section('scripts')
    <script type="text/javascript">
        window.livewire.on('saveModal', () => {
            $('#modalForm').modal('hide');
        });
    </script>
@endsection

