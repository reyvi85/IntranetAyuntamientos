<div>
    <div class="row">
        <div class="col-md-12">
            @include('component.loading')
            <h1>AMPA</h1>
            <div class="row">
                    <div class="col-md-12 form-row">
                        <div class="form-group col-md-12">
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Buscar" wire:model="search">
                        </div>

                </div>
            </div>

            <div class="col-md-12">
                @if(count($listAmpa) > 1)
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">DNI</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($listAmpa as $row)
                            <tr>
                                <th scope="row">{{$row->Nombre}}</th>
                                <td>{{$row->Dni}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    @if(count($listAmpa) == 1)
        <div class="row">
            <div class="col-md-4">
                <i class="fas fa-check-circle fa-10x" style="color: #1d643b"></i>
            </div>
        </div>
    @elseif(count($listAmpa) == 0)
        <div class="row">
            <div class="col-md-4">
                <i class="fas fa-window-close fa-10x" style="color: #761b18"></i>
            </div>
            <div class="col-md-8">
                <p class="text-center">No hay datos relacionados a este cliente!</p>
            </div>
        </div>
    @endif
</div>
