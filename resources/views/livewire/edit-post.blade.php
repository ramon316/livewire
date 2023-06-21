<div>
    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            wire:click="$set('open', true)">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
        </svg>
    </div>

    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            Editar el post
        </x-slot>
        <x-slot name="content">
            <div class="mb-6">
                {{-- Mmostramos el mensaje de carga --}}
                <div class="flex w-full m-1 font-medium py-1 px-2 rounded-md text-red-700 bg-red-100 border border-red-300"
                    wire:loading wire:target="image">
                    <div class="text-xl font-normal  max-w-full flex-initial">
                        Espere un momento, la imagen se esta cargando.
                    </div>
                </div>
                <div class="mb-1">
                    @if ($image)
                        <img src="{{ $image->temporaryUrl() }}" alt="">
                    @else
                        <img src="{{ Storage::Url($post->image)}}">
                    @endif
                </div>
            </div>
            <div class="mb-6">
                <x-label> Título del post</x-label>
                <x-input type="text" class="w-full" wire:model="post.title"></x-input>
            </div>
            <div class="mb-6">
                <x-label value="Contenido"></x-label>
                <textarea class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                    rows="5" wire:model="post.content"></textarea>
                <x-input-error for="content"></x-input-error>
            </div>
            <div class="mb-6">
                <input type="file" wire:model="image" id="{{ $identificador }}">
                <x-input-error for="image"></x-input-error>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('open', false)" wire:loading.remove wire:target="image">Cancelar
            </x-secondary-button>
            <x-button class="ml-2 disabled:opacity-30" type="button" wire:click="save" wire:loading.remove
                wire:target="save, image">
                Editar Post
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
