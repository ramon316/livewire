<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form class="rounded-lg p-10">
                <div class="mb-4 flex items-center">
                    <x-input type="text" class="flex-1" placeholder="Search..." wire:model="search"></x-input>
                    @livewire('create-post')
                </div>
            </form>
            @if ($posts->count())
                <x-table>
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-8 cursor-pointer" wire:click="order('id')">
                                    Id
                                    @if ($sort == 'id' and $direction == 'desc')
                                        <i class="fa-solid fa-sort-down float-right mt-1 ml-3"></i>
                                    @elseif ($sort == 'id' and $direction == 'asc')
                                        <i class="fa-solid fa-sort-up float-right mt-1 ml-3"></i>
                                    @else
                                        <i class="fa-solid fa-sort float-right mt-1 ml-3"></i>
                                    @endif
                                </th>
                                <th class="py-3 px-6 cursor-pointer" wire:click="order('title')">
                                    Título
                                    @if ($sort == 'title' and $direction == 'desc')
                                    <i class="fa-solid fa-sort-down float-right mt-1 ml-3"></i>
                                @elseif ($sort == 'title' and $direction == 'asc')
                                    <i class="fa-solid fa-sort-up float-right mt-1 ml-3"></i>
                                @else
                                    <i class="fa-solid fa-sort float-right mt-1 ml-3"></i>
                                @endif
                                </th>
                                <th class="py-3 px-6 cursor-pointer" wire:click="order('content')">
                                    Contenido
                                    @if ($sort == 'content' and $direction == 'desc')
                                    <i class="fa-solid fa-sort-down float-right mt-1 ml-3"></i>
                                @elseif ($sort == 'content' and $direction == 'asc')
                                    <i class="fa-solid fa-sort-up float-right mt-1 ml-3"></i>
                                @else
                                    <i class="fa-solid fa-sort float-right mt-1 ml-3"></i>
                                @endif
                                </th>
                                <th class="py-3 px-6 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach ($posts as $item)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="mr-2">
                                                {{ $item->id }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        <div class="flex items-center">
                                            <div class="mr-2">
                                                {{ $item->title }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            {{ $item->content }}
                                        </div>
                                    </td>
                                    <td class="py-3 px-6">
                                        <div class="flex item-center justify-center">
                                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </div>

                                            {{-- @livewire('edit-post', ['post' => $post], key($post->id)) --}}
                                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    wire:click="edit({{ $item}})">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </div>

                                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejosin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </x-table>
            @else
                <label class="text-red-600">No existen registros con las especificacipones dadas</label>
            @endif
        </div>
    </div>


    <x-dialog-modal wire:model="open_edit">
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
            <x-secondary-button wire:click="$set('open_edit', false)" wire:loading.remove wire:target="image">Cancelar
            </x-secondary-button>
            <x-button class="ml-2 disabled:opacity-30" type="button" wire:click="update" wire:loading.remove
                wire:target="save, image">
                Editar Post
            </x-button>
        </x-slot>
    </x-dialog-modal>

</div>
