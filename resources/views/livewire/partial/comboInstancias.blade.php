@if ($listInstance->count())
    @if ($label)
        <label>Instancias:</label>
    @endif
        <select class="form-control @error('instance_id') is-invalid @enderror" wire:model="instance_id">
            <option value="">-- Instancias --</option>
            @foreach($listInstance as $int)
                <option value="{{$int->id}}">{{$int->name}}</option>
            @endforeach
        </select>
        @error('instance_id')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
@endif
