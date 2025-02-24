<div>
    <form wire:submit="addNewFeature" class="flex space-x-4">
        <div class="flex-1">
            <x-label class="mb-1">Valor</x-label>


            @switch($option->type)
                @case(1)
                    <x-input wire:model="newFeature.value" class="w-full" placeholder="Ingrese un valor" />
                @break

                @case(2)
                    <div class="border border-gray-300 h-[42px] rounded-md flex items-center px-3 justify-between">
                        {{ $newFeature['value'] ?: 'Seleccione un color' }}
                        <x-input type="color" wire:model.live="newFeature.value"
                            class="shadow-lg  rounded-full border-2 border-gray-300 mr-4" />
                    </div>
                @break

                @default
            @endswitch
        </div>

        <div class="flex-1">
            <x-label class="mb-1">Descripción</x-label>
            <x-input wire:model="newFeature.description" class="w-full" placeholder="Ingrese una descripción" />
        </div>

        <div class="pt-7">
            <x-button>Agregar</x-button>
        </div>
    </form >
</div>
