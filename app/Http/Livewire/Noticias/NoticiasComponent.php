<?php

namespace App\Http\Livewire\Noticias;

use App\Models\Post;
use App\Traits\DataModels;
use App\Traits\DataModelsInstances;
use App\Traits\DataModelsNews;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class NoticiasComponent extends Component
{
    use DataModels, DataModelsInstances, DataModelsNews, WithPagination, WithFileUploads;

    public $search, $postSelected, $imagePost, $fechaFilter, $residentesFilter,
        $titulo,
        $subtitulo,
        $contenido,
        $image,
        $fechaNews,

        $fecha_inicio, $fecha_fin,

        $visitantes,
        $residentes,
        $inicio,
        $active;

    protected $rules = [
        'titulo'=>'required',
        'subtitulo'=>'required',
        'contenido'=>'required',
        'image'=>'required|image|max:3072',
        'fechaNews'=>'required',
        'instanceSelected'=>'required'
    ];

    protected $messages = [
        'instanceSelected.required'=>'Debe seleccionar una instancia!',
        'fechaNews.required'=>'Debe seleccionar un rango de fecha!'
    ];

    protected $listeners = [
        'getFechaFilter', 'getAddFecha', 'getContenido'
    ];

    public function mount(){
        $this->checkInstanceForUser();
        $this->setPatchToUpload('images/post');
        $this->setConfigModal();
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

    public function getFechaFilter($value){
        if(!is_null($value))
            $this->fechaFilter = $value;
    }

    public function getAddFecha($value){
        if(!empty($value)){
            $this->fecha_inicio = $value[0];
            $this->fecha_fin = $value[1];
            $this->fechaNews = $this->fecha_inicio.'/'.$this->fecha_fin;
        }else{
            $this->fechaNews = null;
        }

    }
    public function getContenido($value){
        if(!is_null($value))
            $this->contenido = $value;
    }

    public function resetProps(){
        $this->reset(['postSelected', 'imagePost', 'titulo', 'subtitulo', 'contenido', 'image', 'fechaNews', 'fecha_inicio', 'fecha_fin',
                'visitantes', 'residentes', 'inicio', 'active', 'modalModeDestroy'
            ]);
        $this->resetErrorBag();
    }

    public function add(){
        $this->resetProps();
        $this->dispatchBrowserEvent('text', ['text' => '']);
        $this->setConfigModal('Nueva noticia');
        $this->active = true;
    }

    public function store(){
        $this->validate();
        $img = $this->image->store($this->getPatchToUpload(), 'public');
        Post::create([
            'titulo'=>$this->titulo,
            'subtitulo'=>$this->subtitulo,
            'contenido'=>$this->contenido,
            'image'=>$img,
            'fecha_inicio'=>$this->fecha_inicio,
            'fecha_fin'=>$this->fecha_fin,
            'visitantes'=>$this->visitantes,
            'residentes'=>$this->residentes,
            'inicio'=>$this->inicio,
            'active'=>$this->active,
            'slug'=>Str::slug($this->titulo),
            'instance_id'=>$this->instanceSelected
        ]);
        $this->emit('saveModal');
        $this->resetProps();
    }

    public function edit(Post $post){
        $this->dispatchBrowserEvent('text', ['text' => $post->contenido]);
        $this->resetProps();
        $this->setConfigModal('Editar', 'fa-edit', 'edit');
        $this->instanceSelected = $post->instance_id;
        $this->postSelected = $post->id;
        $this->imagePost = $post->image;
        $this->titulo = $post->titulo;
        $this->subtitulo = $post->subtitulo;
        $this->contenido = $post->contenido;
        $this->fechaNews = $post->fecha_inicio.' / '.$post->fecha_fin;

        $this->fecha_inicio = $post->fecha_inicio;
        $this->fecha_fin = $post->fecha_fin;

        $this->visitantes = $post->visitantes;
        $this->residentes = $post->residentes;
        $this->inicio = $post->inicio;
        $this->active = $post->active;
    }

    public function update_news(Post $post){
       $this->validate([
           'titulo'=>'required',
           'subtitulo'=>'required',
           'contenido'=>'required',
           'image'=>'nullable|image|max:3072',
           'fechaNews'=>'required',
           'instanceSelected'=>'required'
       ]);
        if($this->image){
            Storage::disk('public')->delete($post->image);
            $img = $this->image->store($this->getPatchToUpload(), 'public');
        }else{
            $img = $post->image;
        }
       $post->fill([
        'titulo'=>$this->titulo,
        'subtitulo'=>$this->subtitulo,
        'contenido'=>$this->contenido,
        'image'=>$img,
        'fecha_inicio'=>$this->fecha_inicio,
        'fecha_fin'=>$this->fecha_fin,
        'visitantes'=>$this->visitantes,
        'residentes'=>$this->residentes,
        'inicio'=>$this->inicio,
        'active'=>$this->active,
        'slug'=>Str::slug($this->titulo),
        'instance_id'=>$this->instanceSelected
       ])->save();
        $this->resetProps();
       $this->emit('saveModal');
    }

    public function trash(Post $post){
        $this->setConfigModal('Eliminar', 'fa-trash', 'trash');
        $this->postSelected = $post->id;
        $this->titulo = $post->titulo;
    }

    public function destroy(Post $post){
        Storage::disk('public')->delete($post->image);
        $post->delete();
        $this->emit('saveModal');
        $this->resetProps();
    }



    public function render()
    {
        $news = $this->getNoticias($this->search, $this->instancias, $this->fechaFilter, $this->sort, $this->sortDirection);
        return view('livewire.administrator.noticias.noticias-component', compact('news'))
            ->extends('layouts.app');
    }
}
