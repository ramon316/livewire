<div>
    <x-button class="ml-2" type='button' wire:click="$set('open', true)">Nuevo Post</x-button>

    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            Crear nuevo post
        </x-slot>
        <x-slot name="content">
            <div class="mt-2">
                <div class="mb-6">
                    {{-- Mmostramos el mensaje de carga --}}
                    <div class="flex w-full m-1 font-medium py-1 px-2 rounded-md text-red-700 bg-red-100 border border-red-300" wire:loading wire:target="image">
                        <div class="text-xl font-normal  max-w-full flex-initial">
                            Espere un momento, la imagen se esta cargando.
                        </div>
                    </div>
                    <div class="mb-1">
                        @if ($image)
                            <img src="{{ $image->temporaryUrl() }}" alt="">
                        @endif
                    </div>

                </div>
                <div class="mb-6">
                    <x-label value="Título del post"></x-label>
                    <x-input type="text" class="w-full" wire:model="title"></x-input>
                    <x-input-error for="title"></x-input-error>
                </div>
                <div class="mb-6">
                    <x-label value="Contenido"></x-label>
                    <textarea class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                        rows="5" wire:model.defer="content"></textarea>
                    <x-input-error for="content"></x-input-error>
                </div>
                <div class="mb-6">
                    <input type="file" wire:model="image" id="{{ $identificador}}">
                    <x-input-error for="image"></x-input-error>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('open', false)" wire:loading.remove wire:target="image">Cancelar</x-secondary-button>
            <x-button class="ml-2 disabled:opacity-30" type="button" wire:click="save" wire:loading.remove wire:target="save, image">
                Crear Post
            </x-button>
        </x-slot>
    </x-dialog-modal>

</div>
