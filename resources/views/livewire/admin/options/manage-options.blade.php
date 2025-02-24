<div>
    <section class="rounded-lg bg-white shadow-lg">
        <header class="border-b border-gray-200 px-6 py-2">
            <div class="flex justify-between">
                <h1 class="text-lg font-semibold text-gray-700">
                    Opciones
                </h1>

                <x-button wire:click="$set('newOption.openModal', true)">Nuevo</x-button>
            </div>
        </header>

        <div class="p-6">
            <div class="space-y-6">
                @foreach ($options as $option)
                    <div class="p-6 rounded-lg border border-gray-200 relative" wire:key="option-{{ $option->id }}">
                        <div class="absolute -top-3 px-4 bg-white">

                            <button class="mr-1" onclick="confirmDelete({{ $option->id }}, 'option')">
                                <i class="fa-solid fa-trash-can text-red-500 hover:text-red-700"></i>
                            </button>

                            <span>
                                {{ $option->name }}
                            </span>
                        </div>
                        <div class="flex flex-wrap mb-4">
                            {{-- valores --}}
                            @foreach ($option->features as $feature)
                                @switch($option->type)
                                    @case(1)
                                        {{-- texto --}}
                                        <span
                                            class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-gray-400 border border-gray-500">
                                            {{ $feature->description }}
                                            <button class="ml-1" {{-- wire:click="deleteFeature({{ $feature->id }})" --}}
                                                onclick="confirmDelete({{ $feature->id }}, 'feature')">
                                                <i class="fas solid fa-xmark hover:text-red-500"></i>
                                            </button>
                                        </span>
                                    @break

                                    @case(2)
                                        {{-- color --}}
                                        <div class="relative">
                                            <span
                                                class="inline-block w-6 h-6 shadow-lg  rounded-full border-2 border-gray-300 mr-4"
                                                style="background-color: {{ $feature->value }}">
                                            </span>

                                            <button
                                                class="absolute z-10 left-3 -top-2 rounded-full bg-red-500 hover:bg-red-700 h-4 w-4 flex items-center justify-center"
                                                {{-- wire:click="deleteFeature({{ $feature->id }})" --}} onclick="confirmDelete({{ $feature->id }}, 'feature')">
                                                <i class="fas solid fa-xmark text-white text-xs"></i>
                                            </button>
                                        </div>
                                    @break

                                    @default
                                @endswitch
                            @endforeach
                        </div>

                        <div>
                            @livewire('admin.options.addNewFeature', ['option' => $option], key('add-new-feature-' . $option->id))
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-dialog-modal wire:model="newOption.openModal">
        <x-slot name="title">Crear nueva opción</x-slot>
        <x-slot name="content">
            <x-validation-errors class="mb-4"></x-validation-errors>
            <div class="grid grid-cols-2 gap-6 mb-4">
                <div>
                    <x-label class="mb-1">Nombre</x-label>
                    <x-input wire:model="newOption.name" class="w-full" placeholder="Por ejemplo Tamaño, Color:" />
                </div>

                <div>
                    <x-label class="mb-1">Tipo</x-label>
                    <x-select class="w-full" wire:model.live="newOption.type">
                        <option value="1">Texto</option>
                        <option value="2">Color</option>
                    </x-select>
                </div>
            </div>

            <div class="flex items-center mb-4">
                <hr class="flex-1">

                <span class="mx-4">
                    Valores
                </span>

                <hr class="flex-1">

            </div>

            <div class="mb-4 space-y-4">
                @foreach ($newOption->features as $index => $feature)
                    <div class="grid grid-cols-2 gap-6 mb-4 rounded-lg border border-gray-200 p-6 relative"
                        wire:key="feature-{{ $index }}">
                        <div class="absolute -top-3 px-4 bg-white">
                            <button wire:click="removeFeature({{ $index }})" class="p-1 rounded-full bg-red-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500 hover:text-red-800"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div>
                            <x-label class="mb-1">Descripción</x-label>
                            <x-input wire:model="newOption.features.{{ $index }}.description" class="w-full"
                                placeholder="Ingrese una descripción" />
                        </div>

                        <div >
                            <x-label class="mb-1">Valor</x-label>
                            @switch($newOption->type)
                                @case(1)
                                    <x-input wire:model="newOption.features.{{ $index }}.value" class="w-full"
                                        placeholder="Ingrese un valor" />
                                @break

                                @case(2)
                                    <div
                                        class="border border-gray-300 h-[42px] rounded-md flex items-center px-3 justify-between">
                                        {{ $newOption->features[$index]['value'] ?: 'Seleccione un color' }}
                                        <x-input type="color" wire:model.live="newOption.features.{{ $index }}.value"
                                            class="shadow-lg  rounded-full border-2 border-gray-300 mr-4" />
                                    </div>
                                @break

                                @default
                            @endswitch
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex justify-end">
                <x-button wire:click="addFeature">Agregar valor</x-button>
            </div>
        </x-slot>
        <x-slot name="footer">
            <button
                class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150"
                wire:click="addOption">Agregar</button>
        </x-slot>
    </x-dialog-modal>

    @push('js')
        <script>
            function confirmDelete(id, type) {
                Swal.fire({
                    title: "Estas Seguro?",
                    text: "no podras revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, Borrar!",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {

                        switch (type) {
                            case 'feature':
                                @this.call('deleteFeature', id);
                                break;
                            case 'option':
                                @this.call('deleteOption', id);
                                break;
                            default:
                                break;
                        }
                    }
                });
            }
        </script>
    @endpush
</div>
