<div>
    @include('component.loading')
    <div class="form-row">
        <div class="form-group col-md-9">
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Buscar" wire:model="search">
        </div>

        <div class="form-group col-md-3">
            <select class="form-control" wire:model="limitInstance">
                <option value="">-- Todas --</option>
                @for ($i = 5; $i < 55; $i+= 5)
                   <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div>
    </div>

   @if ($instancias->count())
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Instancia</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($instancias as $row)
                    <tr>
                        <th scope="row">
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="instance{{$row->id}}"  value="{{$row->id}}" wire:model="instaceSlecteds.{{$row->id}}">
                            </div>
                        </th>
                        <td>
                            <label class="form-check-label" for="instance{{$row->id}}">
                                {{$row->name}}
                            </label>
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>

        <div class="form-group">
            <button class="btn btn-primary btn-block"  wire:loading.attr="disabled" wire:click="saveInstace({{$userSelected}})"><i class="fas fa-code"></i> Asignar instancias <i wire:loading wire:target="saveInstace" class="fas fa-spinner fa-spin"></i></button>
        </div>

    @else
        <div class="text-center">No hay instancias que mostrar!</div>
   @endif


</div>
