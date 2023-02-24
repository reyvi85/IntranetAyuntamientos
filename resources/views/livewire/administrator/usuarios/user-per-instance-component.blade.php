<div>
    <div class="card">
        <div class="card-header"><i class="fas fa-users"></i> Gestión de usuarios</div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Buscar" wire:model="search">
                </div>
            </div>
            <div class="table-responsive">
                @if($listUsers->count())
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($listUsers as $user)
                            <tr class="link-pointer {{($userSelected == $user->id)?'table-primary':''}}" wire:click="selectUser('{{$user->id}}')">
                                <th scope="row"><i class="fas fa-user"></i></th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <p class="text-center text-muted">No hay usuarios asociados a esta instancia!</p>
                @endif
            </div>
            <div class="row">
                <div class="col-md-12 d-flex justify-content-end">
                    {{$listUsers->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
