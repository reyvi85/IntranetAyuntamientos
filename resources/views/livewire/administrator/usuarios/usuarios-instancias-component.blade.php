<div>
    @include('component.loading')
    <div class="form-row">
        <div class="form-group col-md-7">
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Buscar" wire:model="search">
        </div>

        <div class="form-group col-md-3">
            <select class="form-control" wire:model="rol">
                <option value="">-- Roles --</option>
                @foreach($listRoles as $item)
                    <option value="{{$item}}">{{$item}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md-2">
            <select class="form-control" wire:model="limitUsers">
                <option value="">-- Todos --</option>
                @for ($i = 5; $i < 55; $i+= 5)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div><hr>
    </div>


    <div class="row">
        <div class="col-md-12">
            @if ($userInstance->count())
                <span class="text-uppercase font-weight-bold">Usuarios asociados: </span>
                @foreach($userInstance as $user)
                    <a style="cursor: pointer" class="badge badge-secondary text-lg-right" wire:click="$set('search', '{{$user->name}}')">{{$user->name}}</a>&nbsp;
                @endforeach
            @else
                <p class="text-center text-muted">No hay usuarios para esta instancia!</p>
            @endif

        </div>
    </div>

    <div class="row">
       <div class="col-md-12">
           @if ($usuarios->count())
               <div class="table-responsive">
                   <table class="table">
                       <thead class="thead-dark">
                       <tr>
                           <th scope="col"></th>
                           <th scope="col">Nombre</th>
                           <th scope="col">Email</th>
                           <th scope="col">Rol</th>
                       </tr>
                       </thead>
                       <tbody>
                       @foreach ($usuarios as $row)
                           <tr>
                               <th scope="row">
                                   <div class="form-group form-check">
                                       <input type="checkbox" class="form-check-input" id="user{{$row->id}}"  value="{{$row->id}}" wire:model="userInstanceSelected.{{$row->id}}">
                                   </div>
                               </th>
                               <td>
                                   <label class="form-check-label" for="user{{$row->id}}">
                                       {{$row->name}}
                                   </label>
                               </td>
                               <td>{{$row->email}}</td>
                               <td>{{$row->rol}}</td>
                           </tr>

                       @endforeach
                       </tbody>
                   </table>
               </div>

               <div class="form-group">
                   <button class="btn btn-primary btn-block"  wire:loading.attr="disabled" wire:click="saveUsers({{$instanceSelected}})"><i class="fas fa-users"></i> Asignar usuarios <i wire:loading wire:target="saveUsers" class="fas fa-spinner fa-spin"></i></button>
               </div>
           @else
               <div class="text-center">No hay instancias que mostrar!</div>
           @endif
       </div>
    </div>

</div>
