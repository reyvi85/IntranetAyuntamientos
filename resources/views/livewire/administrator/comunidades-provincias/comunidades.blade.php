<div class="col-md-12">
    <form>
        <div class="form-row">
            <div class="form-group col-md-10">
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Buscar">
        </div>
            <div class="form-group col-md-2">
                <a class="btn btn-primary btn-block" href="#" role="button"><i class="fas fa-plus-circle"></i> Añadir</a>
            </div>
        </div>

    </form>

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col"></th>
            <th scope="col">Comunidades</th>
            <th colspan="3" class="text-center" scope="col">Opciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($listComunidades as $row)
            <tr>
                <th scope="row" class="align-middle"><i class="fas fa-plus"></i></th>
                <td class="align-middle ">{{$row->name}}</td>
                <td class="align-middle"><i class="fas fa-edit"></i></td>
                <td class="align-middle"><i class="fas fa-trash"></i></td>
                <td class="align-middle"><a href="javascript:void(0)" class="btn btn-primary btn-block"><i class="fas fa-plus-circle"></i> Provincias ({{$row->provincias_count}})</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

