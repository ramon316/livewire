<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class Showpost extends Component
{
    use WithFileUploads;
    public $open_edit = false;
    /* Todos los argumentos se los pasasmmos para su renderizado */
    public $search, $post, $image, $identificador;
    /* Vamos a crear nuestras variables para el ordenamiento */
    public $sort = 'id';
    public $direction = 'desc';

    protected $rules = [
        'post.title'    =>  'required',
        'post.content'  =>  'required',
        'post.image'    =>  'required'
    ];

    /* Escuchar el metodo Emit */
    protected $listeners = ['render'    =>  'render'];

    public function mount()
    {
        $this->identificador = rand();
        $this->post = new Post();
    }

    public function render()
    {
        $posts = Post::where('title', 'like', '%' . $this->search . '%')
            ->orWhere('content', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->get();
        return view('livewire.showpost')->with('posts', $posts);
    }

    public function order($column)
    {
        if ($this->sort == $column) {
            if ($this->direction == 'asc') {
                $this->direction = 'desc';
            } else {
                $this->direction = 'asc';
            }
        } else {
            $this->sort = $column;
        }
    }

    public function edit(Post $post)
    {
        $this->post = $post;
        $this->open_edit = true;

    }

    public function update()
    {
        $this->validate();

        /* Eliminammos la imagen anterior */
        if ($this->image) {
            /* elimino la immagen */
            Storage::delete($this->post->image);
            /* remplazo la nueva imagen */
            $this->post->image = $this->image->store('public/posts-images'); 
        }
        $this->post->save();
        $this->reset(['image']);
        /* gENERAMOS otro identificador a la azar */
        $this->identificador = rand();
        $this->emit('alert','El post se actualizo satisfactoriamente');
        $this->open_edit = false;
    }
}
