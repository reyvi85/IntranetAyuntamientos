<div class="card">
    <div class="card-header">
       <h5><i class="fas fa-cog"> Rutas</i></h5>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Titulo</th>
                <th scope="col" class="text-center">Visitas</th>
            </tr>
            </thead>
            <tbody>
            @foreach($routes as $row)
                <tr>
                    <td>{{$row->name}}</td>
                    <td class="text-center">{{$row->hit}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
