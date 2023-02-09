@extends('layouts.app')
@section('title','Rutas')
@section('content')
    <div class="col-md-12">
        @component('component.card')
            @slot('titulo')Rutas @endslot
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-link active" id="nav-route-tab" data-toggle="tab" href="#nav-route" role="tab" aria-controls="nav-route" aria-selected="true"><i class="fas fa-map-marker-alt"></i> Rutas</a>
                    @if (auth()->user()->rol == 'Super-Administrador')
                        <a class="nav-link" id="nav-category-tab" data-toggle="tab" href="#nav-category" role="tab" aria-controls="nav-category" aria-selected="false"><i class="fas fa-list"></i> Categorías</a>
                    @endif
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-route" role="tabpanel" aria-labelledby="nav-route-tab">
                    @livewire('routes.routes-component')
                </div>
                @if (auth()->user()->rol == 'Super-Administrador')
                    <div class="tab-pane fade" id="nav-category" role="tabpanel" aria-labelledby="nav-category-tab">
                        @livewire('routes.routes-category-component')
                    </div>
                @endif
            </div>
        @endcomponent
    </div>
    @endsection
@section('scripts')
    <script type="text/javascript">
        window.livewire.on('saveModal', () => {
            $('#modalFormRoutes').modal('hide');
            $('#modalFormCategory').modal('hide');
        });
    </script>
@endsection