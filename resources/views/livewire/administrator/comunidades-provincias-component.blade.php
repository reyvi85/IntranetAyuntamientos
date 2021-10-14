@section('title', 'Comunidades / Provincias')
<div class="col-12">
    @component('component.card')
        @slot('titulo')Comunidades / Provincias @endslot
      <div class="row">
          @include('livewire.administrator.comunidades-provincias.comunidades')
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
