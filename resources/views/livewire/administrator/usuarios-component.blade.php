<div class="col-12">
    @component('component.card')
        @slot('titulo')Gestión de usuarios @endslot
        <div class="row">
            <div class="col-md-12">
                @include('livewire.administrator.usuarios.listUsers')
            </div>
        </div>
    @endcomponent
</div>
@section('scripts')
    <script type="text/javascript">
        window.livewire.on('saveModal', () => {
            $('#modalUsers').modal('hide');
            $('#modalInstancias').modal('hide');
        });
    </script>
@endsection
