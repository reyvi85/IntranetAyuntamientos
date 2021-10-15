@section('title', 'Gestión de Comercios')
<div class="col-12">
    @component('component.card')
        @slot('titulo')Gestión de Comercios @endslot
        <div class="row">
            <div class="col-md-12">
                @include('livewire.administrator.business.listBusiness')
            </div>
        </div>
    @endcomponent
</div>
@section('scripts')
    <script type="text/javascript">
        window.livewire.on('saveModal', () => {
            $('#modalFormBusiness').modal('hide');
        });
    </script>
@endsection
