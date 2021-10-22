    <div class="col-md-12">
        @include('component.loading')
        <div class="row">
            <div class="col-md-12 form-row">
                <div class="form-group col-md-8">
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Buscar" wire:model="search">
                </div>

                <div class="form-group col-md-3">
                    <select class="form-control" wire:model="categorySelected">
                        <option value="">-- Categorías --</option>
                        @foreach($listCategoryBussiness as $ctg)
                            <option value="{{$ctg->id}}">{{$ctg->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1 text-center">
                    <i class="fas fa-th-large fa-2x align-middle"  wire:click="$set('viewList',false)" style="cursor: pointer"></i>&nbsp;
                    <i class="fas fa-th-list fa-2x align-middle" wire:click="$set('viewList',true)" style="cursor: pointer"></i>
                </div>
            </div>

        </div>
        <hr>
        @if ($listBusiness->count())
           @if (!$viewList)
               @include('livewire.front.partial.businessBlock')
           @else
                @include('livewire.front.partial.businessList')
           @endif
        @else
            <div class="row">
                <div class="col-md-12">
                    <p class="text-center">No hay comercios que mostrar!</p>
                </div>
            </div>
        @endif
    </div>




    <div class="row mt-3">
        <div class="col-md-12 d-flex justify-content-end">
            {{$listBusiness->links()}}
        </div>
    </div>
