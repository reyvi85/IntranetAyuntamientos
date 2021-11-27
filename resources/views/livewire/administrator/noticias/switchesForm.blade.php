<div class="custom-control custom-switch">
    <input type="checkbox" class="custom-control-input" wire:click="update_state({{$item->id}},'{{$campo}}')"  id="customSwitches-{{$campo}}-{{$item->id}}" {{($item->$campo)?'checked':''}}>
    <label class="custom-control-label" for="customSwitches-{{$campo}}-{{$item->id}}"></label>
</div>
