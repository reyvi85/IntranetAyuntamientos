<div class="row">
    <div class="col-md-6">
        <h2><i class="fas fa-map-marker-alt"></i> {{$reserve->route->name}}</h2>
        <p class="h4"><i class="fas fa-user" title="Usuario"></i> {{$reserve->user->name}}<br>
            <i class="fas fa-envelope" title="Email"></i> {{$reserve->user->email}}<br>
            <i class="fas fa-calendar" title="Fecha de la reserva"></i> {{$reserve->fecha_reserva}}<br>
            <i class="fas fa-users" title="Número de personas"></i> {{$reserve->num_person}}<br>
            <i class="fas fa-euro-sign" title="Precio"></i> {{($reserve->state)?$reserve->cost:$reserve->route->price * $reserve->num_person}}
        </p>
    </div>
    <div class="col-md-6">
        @if($reserve->state)
            <p class="h5"><i class="fas fa-check"></i> Esta reserva ha sido confirmada!</p>
        @else
            <button class="btn btn-primary btn-block align-middle" wire:loading.attr="disabled"  wire:target="checkReserve" wire:click="checkReserve('{{$reserve->id}}')"><i class="fas fa-paper-plane"></i> Confirmar reserva!</button>
            <div class="text-center text-muted" wire:loading wire:target="checkReserve"><i class="fas fa-spinner fa-spin"></i> Enviando confirmacion de ruta ...</div>
        @endif
    </div>
</div>
