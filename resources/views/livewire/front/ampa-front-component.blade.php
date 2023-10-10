@section('title', 'Socios AMPA CEIP Ana María Matute')
<div>
    <div class="row">
        <div class="col-md-12">
            @include('component.loading')
            <p class="text-center"><img class="img-fluid w-25" src="{{asset('images/logo-AMPA.png')}}"></p>
            <h1 class="text-center">Socios AMPA CEIP Ana María Matute</h1>
            <div class="row">
                    <div class="col-md-12 form-row">
                        <div class="form-group col-md-10">
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="DNI socio" wire:model.defer="search">
                        </div>
                        <div class="form-group col-md-2">
                            <button class="btn btn-primary btn-block"  wire:click="found"><i class="fas fa-search"></i> Buscar</button>
                        </div>

                </div>
            </div>
        </div>
    </div>

    @if(count($listAmpa) == 1)
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header {{($listAmpa->first()->Active == true)?'bg-success':'bg-danger'}} text-dark"><h4><i class="fas {{($listAmpa->first()->Active == true)?'fa-check-circle':'fa-exclamation-triangle'}}"></i> {{$listAmpa->first()->Nombre}} </h4></div>
                    <div class="card-body">
                        <p class="text-center h4"> DNI: {{$listAmpa->first()->Dni}}</p>
                        <p class="text-center"> Socio confirmado correctamente!</p>
                        <p class="text-center h3">{{($listAmpa->first()->Active == true)?'ACTIVO':'INACTIVO'}}</p>

                    </div>
                </div>
            </div>
        </div>
    @elseif($is_empty != false)
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-danger text-white"><h4><i class="fas fa-info-circle"></i> Error!</h4></div>
                    <div class="card-body">
                        <p class="text-center"> Este socio no aparece en nuestros registros!</p>

                    </div>
                </div>
            </div>
        </div>
    @endif
    <hr>
    @if ($listBusiness->count())
            @include('livewire.front.partial.businessBlock')
    @else
        <div class="row">
            <div class="col-md-12">
                <p class="text-center">No hay comercios que mostrar!</p>
            </div>
        </div>
    @endif
    <div class="row mt-3">
        <div class="col-md-12 d-flex justify-content-center">
            {{$listBusiness->links()}}
        </div>
    </div>
</div>
