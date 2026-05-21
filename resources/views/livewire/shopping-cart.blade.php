<div>
    <div class="grid grid-cols-1 lg:grid-cols-7 gap-6">
        <div class="col-span-1 lg:col-span-5">
            <div class="flex justify-between items-center mb-2">
                <h1 class="text-lg">
                    Carrito de compras ({{ Cart::count() }} productos)
                </h1>
                <button class="font-semibold text-gray-600 hover:text-red-800 text-md cursor-pointer hover:underline" wire:click="clearCart()">
                    Vaciar carrito
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>
            <div class="card">
                <ul class="space-y-4">
                    @forelse (Cart::content() as $item)
                        <li class="lg:flex  space-x-4">
                            <img class="w-full lg:w-36 mr-4 aspect-[16/9] object-cover object-center rounded-lg"
                                src="{{ $item->options->image }}" alt="">

                            <div class="w-80">
                                <p class="text-sm">
                                    <a href="{{ route('products.show', $item->id) }}"> {{ $item->name }}</a>
                                </p>

                                <button
                                    class="bg-red-100 hover:bg-red-200 px-2.5  py-1 text-red-800 font-semibold rounded-full cursor-pointer text-xs"
                                    wire:click='remove("{{ $item->rowId }}")'>
                                    <i class="fa-solid fa-trash"></i> Quitar
                                </button>
                            </div>

                            <p>
                                $ {{ $item->price }}
                            </p>

                            <div class="ml-auto space-x-3">
                                <button class="btn btn-gray" wire:click='decrease("{{ $item->rowId }}")'>-</button>
                                <span class="text-lg text-gray-700 inline-block w-2 text-center">{{ $item->qty }}</span>
                                <button class="btn btn-gray" wire:click="increase('{{ $item->rowId }}')">+</button>
                            </div>

                        </li>
                    @empty
                        <li class="text-center py-8">
                            <p>No hay productos en el carrito</p>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
        <div class="col-span-1 lg:col-span-2">
            <div class="card">
                <div class="flex justify-between font-semibold mb-2">
                    <p>Total</p>
                    <p>$ {{ Cart::subtotal() }}</p>
                </div>
                <a href="{{ route('shipping.index') }}" class="btn btn-emerald w-full block text-center">Continuar compra</a>
            </div>
        </div>
    </div>
</div>
