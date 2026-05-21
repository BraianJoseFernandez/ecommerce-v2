<div>
    <section class="bg-white rounded-lg shadow overflow-hidden">
        <header class="bg-gray-900 px-4 py-2 ">
            <h2 class="text-white text-lg ">Direcciones de Envio</h2>
        </header>

        <div class="p-4">
            @if ($new_adress)
                <div class="grid grid-cols-4 gap-4">
                    <div class="col-span-1">
                        <x-select wire:model="CreateAdress.type">
                            <option value="">tipo de direccion</option>
                            <option value="1">casa</option>
                            <option value="2">trabajo</option>
                        </x-select>
                    </div>
                    <div class="col-span-3">
                        <x-input wire:model="CreateAdress.description" type="text" class="w-full"
                            placeholder="direccion del domicilio o trabajo"></x-input>
                    </div>
                    <div class="col-span-2">
                        <x-input wire:model="CreateAdress.city" type="text" class="w-full"
                            placeholder="ciudad"></x-input>
                    </div>
                    <div class="col-span-2">
                        <x-input wire:model="CreateAdress.reference" type="text" class="w-full"
                            placeholder="referencia"></x-input>
                    </div>

                    <div class="col-span-1">
                        <x-input wire:model="CreateAdress.postal_code" type="text" class="w-full"
                            placeholder="codigo postal"></x-input>
                    </div>

                </div>

                <hr class="my-4">

                <div>
                    <p class="font-semibold mb-2">
                        ¿Quien recibira este pedido?
                    </p>

                    <div class="flex space-x-2 mb-4">
                        <label class="flex items-center cursor-pointer">
                            <input class="mr-1" type="radio" name="receiver" value="1"
                                wire:model="CreateAdress.receiver">
                            Yo
                        </label>

                        <label class="flex items-center cursor-pointer">
                            <input class="mr-1" type="radio" name="receiver" value="0"
                                wire:model="CreateAdress.receiver">
                            Otro
                        </label>
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <x-input wire:model="CreateAdress.receiver_info.name" type="text" class="w-full"
                                placeholder="Nombre"></x-input>
                        </div>
                        <div>
                            <x-input wire:model="CreateAdress.receiver_info.lastname" type="text" class="w-full"
                                placeholder="Apellido"></x-input>
                        </div>
                        <div class="flex space-x-2">
                            <x-select>
                                @foreach (\App\Enums\TypeOfDocuments::cases() as $item)
                                    <option value="{{ $item->value }}">{{ $item->name }}</option>
                                @endforeach
                            </x-select>

                            <x-input wire:model="CreateAdress.receiver_info.document" type="text" class="w-full"
                                placeholder="Documento"></x-input>

                        </div>

                        <div>
                            <x-input wire:model="CreateAdress.receiver_info.phone" type="text" class="w-full"
                                placeholder="Telefono"></x-input>
                        </div>
                        <div class="col-span-2">
                            <x-input wire:model="CreateAdress.receiver_info.email" type="text" class="w-full"
                                placeholder="Email"></x-input>
                        </div>

                        <div>
                            <button class="btn btn-outline-gray w-full">
                                Cancelar
                            </button>
                        </div>
                        <div>
                            <button class="btn btn-emerald w-full">
                                Guardar
                            </button>
                        </div>

                    </div>
                </div>
            @else
                @if ($adresses->count())
                    @foreach ($adresses as $adress)
                        <div class="border-b border-gray-200 py-4">
                            <p>{{ $adress->description }}</p>
                        </div>
                    @endforeach
                @else
                    <div class="grid grid-cols-4 gap-4 "></div>
                @endif

                <button class="btn btn-outline-gray w-full flex justify-center items-center mt-4"
                    wire:click="$set('new_adress', true)">
                    Agregar <i class="fa-solid fa-plus ml-2"></i>
                </button>
            @endif

        </div>
    </section>
</div>
