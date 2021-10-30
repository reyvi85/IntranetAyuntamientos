@if ($listInstance->count())
    @if ($label)
        <label>Instancias:</label>
    @endif
        <select class="form-control @error($ModelName) is-invalid @enderror" wire:model="{{$ModelName}}">
            <option value="">-- Instancias --</option>
            @foreach($listInstance as $int)
                <option value="{{$int->id}}">{{$int->name}}</option>
            @endforeach
        </select>
        @error($ModelName)
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
@endif
