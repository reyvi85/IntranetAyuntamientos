<div class="row">
    <div class="col-md-6">
        <h2><i class="fas fa-map-marker-alt"></i> {{$reserve->route->name}}</h2>
        <p class="h4"><i class="fas fa-user" title="Usuario"></i> {{$reserve->user->name}}<br>
            <i class="fas fa-envelope" title="Email"></i> {{$reserve->user->email}}<br>
            <i class="fas fa-calendar" title="Fecha de la reserva"></i> {{$reserve->fecha_reserva}}<br>
            <i class="fas fa-euro-sign" title="Precio"></i> {{$reserve->route->price}}
        </p>
    </div>
    <div class="col-md-6">
        @if($reserve->state)
            <p class="h5"><i class="fas fa-check"></i> Esta reserva ha sido confirmada!</p>
        @else
            <button class="btn btn-primary btn-block align-middle" wire:click="checkReserve('{{$reserve->id}}')"><i class="fas fa-paper-plane"></i> Confirmar reserva!</button>
        @endif
    </div>
</div>
