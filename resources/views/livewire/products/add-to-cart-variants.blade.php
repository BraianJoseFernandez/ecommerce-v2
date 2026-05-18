<x-container class="px-4 my-4">
    <div class="card">
        <div class="grid md:grid-cols-2 gap-6">
            <div class="col-span-1">
                <figure class="">
                    <img src="{{ $this->variant->image }}" alt="{{ $product->name }}"
                        class="aspect-[1/1] object-cover object-center w-full">
                </figure>
                
            </div>
            <div>
                <h1 class="text-xl text-gray-700 mb-2 ">
                    {{ $product->name }}
                </h1>
                <div class="flex items-center space-x-2 mb-4">
                    <ul class="flex space-x-1 mb-2 text-sm">
                        <li>
                            <i class="fa-solid text-sm fa-star text-yellow-400"></i>
                            <i class="fa-solid text-sm fa-star text-yellow-400"></i>
                            <i class="fa-solid text-sm fa-star text-yellow-400"></i>
                            <i class="fa-solid text-sm fa-star text-yellow-400"></i>
                            <i class="fa-solid text-sm fa-star text-yellow-400"></i>
                        </li>
                    </ul>
                    <p class="text-sm text-gray-700">4.7 (356 reviews)</p>
                </div>

                <p class="font-bold text-2xl text-gray-700 mb-4">
                    $ {{ $product->price }}
                </p>

                <div class="flex space-x-6 mb-6 items-center" x-data="{qty: @entangle('qty')}">
                    <p class="text-sm text-gray-700">Cantidad:</p>
                    <button class="btn btn-gray" x-on:click="qty--" x-bind:disabled="qty <= 1">-</button>
                    <span class="text-lg text-gray-700 inline-block w-2 text-center" x-text="qty"></span>
                    <button class="btn btn-gray" x-on:click="qty++">+</button>
                </div>

                <div class="flex flex-wrap gap-2 mb-6">
                    @foreach ($product->options as $option)
                    <div class="mr-4 mb-4">
                        <p class="font-semibold mb-2 text-lg">
                            {{ $option->name }}
                        </p>
                        <ul class="flex items-center space-x-4">
                            @foreach ($option->pivot->features as $feature)
                                <li class="mb-2">
                                    @switch($option->type)
                                        @case(1)
                                            <button class="w-20 h-8 font-semibold uppercase text-sm rounded-lg  {{ $selectedFeatures[$option->id] == $feature['id'] ? 'bg-emerald-600 text-white' : 'border border-gray-300 text-gray-700' }} " wire:click="$set('selectedFeatures.{{ $option->id }}', '{{ $feature['id'] }}')">
                                                {{ $feature['value'] }}
                                            </button>
                                            @break
                                    
                                        @case(2)
                                        <div class="p'0.5 border-2 rounded-lg flex items-center -mt-1">
                                            <button class="w-20 h-8 font-semibold uppercase text-sm rounded-lg  {{ $selectedFeatures[$option->id] == $feature['id'] ? 'border-4 border-emerald-700' : 'border-transparent' }} " wire:click="$set('selectedFeatures.{{ $option->id }}', '{{ $feature['id'] }}')"
                                                style="background-color: {{ $feature['value'] }}">
                                            </button>
                                        </div>
                                            @break
                                        @default
                                            
                                    @endswitch
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @endforeach

                </div>

                <button class="btn btn-emerald w-full mb-4" wire:click="add_to_cart" wire:loading.attr="disabled">Agregar al carrito</button>

                <div class="text-sm mb-4">
                    {{ $product->description }}
                </div>
                <div class="flex items-center text-gray-700 space-x-4 mb-6">
                    <i class="fa-solid fa-truck-fast text-2xl text-emerald-700"></i>
                    <p class="text-emerald-700">Envio a domicilio</p>
                </div>
            </div>
        </div>
    </div>
</x-container>

