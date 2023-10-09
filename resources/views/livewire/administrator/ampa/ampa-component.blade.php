@section('title', 'A M P A')
<div class="col-12">
    @component('component.card')
        @slot('titulo')A M P A @endslot
        <div class="row">
            <div class="col-md-12">
                @include('livewire.administrator.ampa.lista-asociados')
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
