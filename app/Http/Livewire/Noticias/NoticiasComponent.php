<?php

namespace App\Http\Livewire\Noticias;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class NoticiasComponent extends Component
{
    use WithPagination, WithFileUploads;

    public $search, $postSelected,
        $titulo,
        $subtitulo,
        $contenido,
        $image,
        $fecha_inicio,
        $fecha_fin,
        $visitantes,
        $residentes,
        $inicio,
        $slug;

    protected $rules = [
        'titulo'=>'required',
        'subtitulo'=>'required',
        'contenido'=>'required',
        'image'=>'required|image|max:3072',
        'fecha_inicio'=>'required|',
        'fecha_fin'=>'required|date',
        'instanceSelected'=>'required|'
    ];


    public function render()
    {
        return view('livewire.administrator.noticias.noticias-component');
    }
}
