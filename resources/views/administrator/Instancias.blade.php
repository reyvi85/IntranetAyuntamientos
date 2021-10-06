@extends('layouts.app')
@section('content')
    <div class="col-md-12">
        @livewire('instancias-component')
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        window.livewire.on('saveModal', () => {
            $('#modalForm').modal('hide');
        });
    </script>
@endsection
