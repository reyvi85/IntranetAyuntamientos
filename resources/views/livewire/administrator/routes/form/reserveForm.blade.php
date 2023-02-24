<div class="form-row">
    <div class="form-group col-md-6">
        @php($label = true)
        @php($ModelName = 'instanceSelected')
        @include('livewire.partial.comboInstancias')
    </div>

    @if($instanceSelected)
        <div class="form-group col-md-6">
            <label>Rutas: <span wire:loading wire:target="instanceSelected"><i class="fas fa-spinner fa-spin"></i></span></label>
            <select class="form-control @error('routeSelected') is-invalid @enderror" wire:model="routeSelected">
                <option value="">-- Rutas --</option>
                @foreach($listRoutes as $int)
                    <option value="{{$int->id}}">{{$int->name}}</option>
                @endforeach
            </select>
            @error('routeSelected')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    @endif
</div>
<span wire:loading wire:target="instanceSelected"><i class="fas fa-spinner fa-spin"></i> Cargando usuarios ...</span>
@if($instanceSelected)
@livewire('usuarios.user-per-instance-component', ['selectInstance'=>$instanceSelected])
@endif
