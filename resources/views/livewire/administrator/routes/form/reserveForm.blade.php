@include('livewire.partial.error')
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

<div class="form-row">
    <div class="form-group col-md-2">
        <label for="name"># Personas:</label>
        <input type="text" class="form-control @error('numPerson') is-invalid @enderror" id="name" wire:model.defer="numPerson">
    </div>

    <div class="form-group col-md-2">
        <label>Día:</label>
        <select class="form-control @error('dia') is-invalid @enderror" wire:model="dia">
            <option value="">-- Día --</option>
            @for($i=1; $i<=31; $i++)
                <option value="{{(strlen($i) == 1)?'0'.$i:$i}}">{{$i}}</option>
            @endfor
        </select>
    </div>

    <div class="form-group col-md-2">
        <label>Meses:</label>
        <select class="form-control @error('mes') is-invalid @enderror" wire:model="mes">
            <option value="">-- Mes --</option>
            @foreach($meses as $key=>$mes)
                <option value="{{$key}}">{{$mes}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-md-2">
        <label>Años:</label>
        <select class="form-control @error('year') is-invalid @enderror" wire:model="year">
            <option value="">-- Año --</option>
            @for($i=date('Y'); $i<=date('Y')+3; $i++)
                <option value="{{$i}}">{{$i}}</option>
            @endfor
        </select>
    </div>

    <div class="form-group col-md-2">
        <label>Hora:</label>
        <select class="form-control @error('hrs') is-invalid @enderror" wire:model="hrs">
            <option value="">-- Hora --</option>
            @for($i=1; $i<=23; $i++)
                <option value="{{(strlen($i) == 1)?'0'.$i:$i}}">{{$i}}</option>
            @endfor
        </select>
    </div>

    <div class="form-group col-md-2">
        <label>Minutos:</label>
        <select class="form-control @error('min') is-invalid @enderror" wire:model="min">
            <option value="">-- Minutos --</option>
            @for($i=0; $i<=55; $i+=5)
                <option value="{{(strlen($i) == 1)?'0'.$i:$i}}">{{(strlen($i) == 1)?'0'.$i:$i}}</option>
            @endfor
        </select>
    </div>


</div>



<span wire:loading wire:target="instanceSelected"><i class="fas fa-spinner fa-spin"></i> Cargando usuarios ...</span>
@if($instanceSelected)
@livewire('usuarios.user-per-instance-component', ['selectInstance'=>$instanceSelected])
@endif
