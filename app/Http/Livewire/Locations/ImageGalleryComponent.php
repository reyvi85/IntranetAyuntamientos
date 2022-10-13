<?php

namespace App\Http\Livewire\Locations;

use App\Models\Location;
use App\Models\LocationGallery;
use App\Traits\DataModels;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImageGalleryComponent extends Component
{
    use DataModels, WithFileUploads;

    public $locationSelected,
           $imageGallery = [];

    protected $rules = [
        'imageGallery.*' => 'nullable|image', // 1MB Max
    ];

    protected $listeners =["addImage"=>'setImageGallery', 'resetGallery', 'destroyImage'=>'render'];

    public function setImageGallery(Location $location){
        $this->locationSelected = $location;
            $this->_createGellery($location);
            $this->reset('imageGallery');
    }

    public function resetGallery(){
        $this->reset(['imageGallery', 'locationSelected']);
    }

    public function mount(){
        $this->setPatchToUpload('images/localizaciones/galerias');
    }

    protected function _createGellery($modelLocation){
        foreach ($this->imageGallery as $image) {
            $gImage = $image->store($this->getPatchToUpload(), 'public');
            $modelLocation->gallery()->create([
                'image' => $gImage
            ]);
        }
    }

    public function destroyImageGalery(LocationGallery $locationGallery){
        Storage::disk('public')->delete($locationGallery->image);
        $locationGallery->delete();
        $this->emit('destroyImage');
    }

    public function render()
    {
        return view('livewire.administrator.locations.image-gallery-component');
    }
}
