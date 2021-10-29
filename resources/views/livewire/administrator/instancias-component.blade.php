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
    <script type="text/javascript">
        window.livewire.on('saveModal', () => {
            $('#modalInstancia').modal('hide');
        });
    </script>
@endsection
