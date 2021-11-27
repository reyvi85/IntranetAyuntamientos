<?php

namespace App\Http\Livewire\Noticias;

use App\Models\Post;
use App\Traits\DataModels;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class NoticiasComponent extends Component
{
    use DataModels, WithPagination, WithFileUploads;

    public $search, $postSelected, $imagePost, $fechaFilter, $residentesFilter,
        $titulo,
        $subtitulo,
        $contenido,
        $image,
        $fecha_inicio,
        $fecha_fin,
        $visitantes,
        $residentes,
        $inicio,
        $active,
        $slug;

    protected $rules = [
        'titulo'=>'required',
        'subtitulo'=>'required',
        'contenido'=>'required',
        'image'=>'required|image|max:3072',
        'fecha_inicio'=>'required|',
        'fecha_fin'=>'required|date',
        'instanceSelected'=>'required'
    ];

    public function mount(){
        $this->checkInstanceForUser();
    }

    public function update_state(Post $post, $state){
        $campos = collect(['visitantes', 'residentes', 'inicio', 'active']);
        if(!is_array($state) && $campos->contains($state)){
            $post->fill([
                $state=>($post->$state == 1)?0:1
            ])->save();
        }
        else{
            abort(403);
        }
    }


    public function render()
    {
        $news = $this->getNoticias($this->search, $this->instancias, $this->fechaFilter, $this->sort, $this->sortDirection);
        return view('livewire.administrator.noticias.noticias-component', compact('news'))
            ->extends('layouts.app');
    }
}
