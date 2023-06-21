<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CreatePost extends Component
{
    use WithFileUploads;
    public $image;
    public $open = false;
    public $title, $content, $identificador;

    /* Reglas de valicación */
    protected $rules = [
        'title' =>  'required|max:10',
        'content'   =>  'required|max:100',
        'image'     =>  'required|image|max:2048'
    ];

    public function mount(){
        $this->identificador = rand();
    }

    public function render()
    {
        return view('livewire.create-post');
    }

    public function save()
    {
        $this->validate();

        $image = $this->image->store('public/posts-images');

        Post::create([
            'title'     =>  $this->title,
            'content'   =>  $this->content,
            'image'     =>  $image,
        ]);
        /* Limpiar nuestro modal Opcion1*/
        $this->reset(['open', 'title', 'content', 'image']);
        /* gENERAMOS otro identificador a la azar */
        $this->identificador = rand();
        /* Método emit o EmmitTo */
        $this->emitTo('showpost','render');
        /* Alerta de guardado */
        $this->emit('alert','El post se ha creado satisfactoriamente');
        /* Limpiar nuestro mmodal Opcion 2 */
        /* $this->title = '';
        $this->content = '';
        $this->open = false; */

    }

}
