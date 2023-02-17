@extends('layouts.app')
@section('title','Comercios')
@section('content')
    <div class="col-md-12">
        @component('component.card')
            @slot('titulo')Comercios @endslot
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-link active" id="nav-business-tab" data-toggle="tab" href="#nav-business" role="tab" aria-controls="nav-business" aria-selected="true"><i class="fas fa-euro-sign"></i> Comercios</a>
                    @if (auth()->user()->rol == 'Super-Administrador')
                        <a class="nav-link" id="nav-category-tab" data-toggle="tab" href="#nav-category" role="tab" aria-controls="nav-category" aria-selected="false"><i class="fas fa-list"></i> Categorías</a>

                    @endif
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-business" role="tabpanel" aria-labelledby="nav-business-tab">
                    @livewire('business.business-component')
                </div>
                @if (auth()->user()->rol == 'Super-Administrador')
                    <div class="tab-pane fade" id="nav-category" role="tabpanel" aria-labelledby="nav-category-tab">
                        @livewire('business.category-business-component')
                    </div>
                @endif
            </div>
        @endcomponent
    </div>
    @endsection
@section('scripts')
    <script type="text/javascript">
        window.livewire.on('saveModal', () => {
            $('#modalFormBusiness').modal('hide');
            $('#modalFormCategory').modal('hide');
        });
    </script>
@endsection
