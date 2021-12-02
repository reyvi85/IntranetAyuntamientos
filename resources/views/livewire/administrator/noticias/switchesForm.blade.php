<div class="custom-control custom-switch">
    <input type="checkbox" class="custom-control-input" wire:click="update_state({{$row}},'{{$campo}}')"  id="customSwitches-{{$campo}}-{{$row}}" {{($item->$campo)?'checked':''}}>
    <label class="custom-control-label" for="customSwitches-{{$campo}}-{{$row}}"></label>
</div>
