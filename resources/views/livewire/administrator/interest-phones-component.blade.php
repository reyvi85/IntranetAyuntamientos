@section('title', 'Teléfonos de interés')
<div class="col-12">
    @component('component.card')
        @slot('titulo')Teléfonos de interés @endslot
        <div class="row">
            <div class="col-md-12">
                @include('livewire.administrator.interest-phones.listPhone')
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
