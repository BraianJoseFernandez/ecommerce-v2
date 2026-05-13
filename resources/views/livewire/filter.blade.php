<div class="bg-white py-12">
    <x-container class="md:flex px-4">
        @if (count($options))
            <aside class="md:w-52 md:flex-shrink-0 md:mr-8 mb-8 md:mb-0">
                <ul class="space-y-4">
                    @foreach ($options as $option)
                        <li x-data="{ open: true }">
                            <button
                                class="px-4 py-2 bg-gray-200 rounded w-full text-left text-gray-700 flex justify-between items-center"
                                x-on:click="open = !open">
                                {{ $option['name'] }}
                                <i class="fa-solid fa-angle-down"
                                    x-bind:class="{
                                        'fa-angle-up': open,
                                        'fa-angle-down': !open
                                    }"></i>
                            </button>
                            <ul class="mt-2 space-y-2" x-show="open">
                                @foreach ($option['features'] as $feature)
                                    <li>
                                        <label class="inline-flex items-center ">
                                            <x-checkbox 
                                            value="{{ $feature['id'] }}"
                                            wire:model.live="selected_features"
                                            class="mr-2" />
                                            {{ $feature['description'] }}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </aside>
        @endif
        <div class="md:flex-1">
            <div class="flex items-center">
                <span class="mr-2">
                    Ordenar por:
                </span>
                <x-select wire:model.live="orderBy">
                    <option value="1">
                        Relevancia
                    </option>
                    <option value="2">
                        Precio: de Mayor a Menor
                    </option>
                    <option value="3">
                        Precio: de Menor a Mayor
                    </option>
                </x-select>
            </div>
            <hr class="my-4">
            <div class="grid grid-cols-1 sm:grid-cols-2  lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <article class="bg-white rounded-lg shadow p-2 overflow-hidden">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}"
                            class="w-full object-cover h-48 object-center rounded">
                        <div class="p-4">
                            <h1 class="text-lg font-bold text-gray-800 line-clamp-2 mb-2 min-h-[56px]">
                                {{ $product->name }}</h1>
                            <p class="text-gray-600">$ {{ $product->price }}</p>
                        </div>
                        <a href="{{ route('products.show', $product) }}" class="btn btn-emerald block  w-full text-center">Ver Mas</a>
                    </article>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $products->links() }}    
            </div>
        </div>
    </x-container>
</div>
