<x-container class="px-4 my-4">
    <div class="card">
        <div class="grid md:grid-cols-2 gap-6">
            <div class="col-span-1">
                <figure class="mb-2">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}"
                        class="aspect-[16/9] object-cover object-center w-full">
                </figure>
                <div class="text-sm">
                    {{ $product->description }}
                </div>
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
                <button class="btn btn-emerald w-full mb-6">Agregar al carrito</button>

                <div class="flex items-center text-gray-700 space-x-4 mb-6">
                    <i class="fa-solid fa-truck-fast text-2xl text-emerald-700"></i>
                    <p class="text-emerald-700">Envio a domicilio</p>
                </div>
            </div>
        </div>
    </div>
</x-container>
