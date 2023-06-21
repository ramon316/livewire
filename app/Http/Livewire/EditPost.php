<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

use Illuminate\Support\Facades\Storage;

class EditPost extends Component
{
    use WithFileUploads;
    public $post, $image, $identificador;
    public $open = false;

    protected $rules = [
        'post.title'    =>  'required',
        'post.content'  =>  'required'
    ];

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->identificador = rand();
    }

    public function render()
    {
        return view('livewire.edit-post');
    }

    public function save()
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
        $this->reset(['open', 'image']);
        /* gENERAMOS otro identificador a la azar */
        $this->identificador = rand();
        $this->emitTo('showpost', 'render');
        $this->emit('alert','El post se actualizo satisfactoriamente');
    }
}
