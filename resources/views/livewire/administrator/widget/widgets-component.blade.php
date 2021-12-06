@section('title', 'Widgets')
<div class="col-12">
    @component('component.card')
        @slot('titulo')Widgets @endslot
        <div class="row">
            <div class="col-md-12">
                @include('livewire.administrator.widget.lista-widgets')
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