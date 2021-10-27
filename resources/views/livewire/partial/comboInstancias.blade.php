@if ($listInstances->count())
    <div class="form-group">
        <label>Instancias:</label>
        <select class="form-control @error('instance_id') is-invalid @enderror" wire:model.defer="instance_id">
            <option value="">-- Instancias --</option>
            @foreach($listInstances as $int)
                <option value="{{$int->id}}">{{$int->name}}</option>
            @endforeach
        </select>
        @error('instance_id')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
@endif
