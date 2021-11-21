@if ($listAnswers->count())
    <div class="vertical-Scroll">
        <h4 class="text-center text-muted">RESPUESTAS ENVIADAS.</h4>
        @foreach($listAnswers as $asw)
            <p>
                <span class="float-right font-weight-bold">{{$asw->created_at}}</span><br>
                {{$asw->answer}}
            </p>
        @endforeach
    </div>
@else
    <p class="text-center text-muted">No hay respuestas que mostrar!</p>
@endif

<div class="form-group mt-4">
    <textarea class="form-control @error('respuesta') is-invalid @enderror" id="formControlrespuesta" rows="2" wire:model.defer="respuesta"></textarea>
    @error('respuesta')
    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>


    <button type="button" class="btn btn-secondary float-right" wire:loading.attr="disabled" wire:target="storeAnswer"  wire:click="storeAnswer({{$warnigSelected}})"><i class="fas fa-paper-plane"></i> Enviar respuesta</button>
    <div class="text-center text-muted" wire:loading wire:target="storeAnswer"><i class="fas fa-spinner fa-spin"></i></div>

