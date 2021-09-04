<div>
    <div class="row">
        <div class="col-12">
            @component('component.card')
                @slot('titulo')Comunidades / Provincias @endslot
              <div class="row">
                  @include('livewire.administrator.comunidades-provincias.comunidades')
              </div>
            @endcomponent
        </div>
    </div>
</div>
