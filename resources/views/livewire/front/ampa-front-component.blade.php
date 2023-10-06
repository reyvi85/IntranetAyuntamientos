<div>
    <div class="row">
        <div class="col-md-12">
            @include('component.loading')
            <h1 class="text-center">A M P A</h1>
            <div class="row">
                    <div class="col-md-12 form-row">
                        <div class="form-group col-md-12">
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Buscar" wire:model="search">
                        </div>

                </div>
            </div>
        </div>
    </div>

    @if(count($listAmpa) == 1)
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-success text-white"><h4><i class="fas fa-check-circle"></i> {{$listAmpa->first()->Nombre}} </h4></div>
                    <div class="card-body">
                        <p class="text-center h4"> DNI: {{$listAmpa->first()->Dni}}</p>
                        <p class="text-center"> Cliente confirmado correctamente!</p>

                    </div>
                </div>
            </div>
        </div>
    @elseif($is_empty != false )
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-danger text-white"><h4><i class="fas fa-info-circle"></i> Error!</h4></div>
                    <div class="card-body">
                        <p class="text-center"> Este cliente no está en nuestros registros!</p>

                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
