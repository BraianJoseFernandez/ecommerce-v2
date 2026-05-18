<div x-data="{ open: false }">
    <header class="bg-emerald-600 shadow-sm">
        <x-container class="px-4 py-4">
            <div class="flex justify-between items-center space-x-8">
                <button x-on:click="open = true" class="text-3xl ">
                    <i class="fas fa-bars text-white"></i>
                </button>
                <h1 class="text-white">
                    <a href="/" class="inline-flex flex-col items-end">
                        <span class="text-xl md:text-3xl leading-3 md:leading-6 font-semibold">
                            Ecommerce
                        </span>

                        <span class="text-xs">
                            tienda online
                        </span>
                    </a>
                </h1>

                <div class="flex-1 hidden md:block">
                    <x-input oninput="search(this.value)"  placeholder="Buscar por producto, tienda o marca" class="w-full" />
                </div>

                <div class=" flex items-center space-x-4 md:space-x-8">

                    <x-dropdown>
                        <x-slot name="trigger">

                            @auth
                                <button
                                    class="flex items-center text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                    <img class="h-8 w-8 rounded-full object-cover"
                                        src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <button class="text-xl md:text-3xl  text-white">
                                    <i class="fas fa-user"></i>
                                </button>
                            @endauth
                        </x-slot>
                        <x-slot name="content">
                            @guest
                                <div class="py-2 px-4 ">
                                    <div class="flex justify-center">
                                        <a href="{{ route('login') }}" class="btn btn-emerald">
                                            Iniciar Sesion
                                        </a>
                                    </div>
                                    <p class="text-sm text-center mt-2">
                                        ¿No tienes una cuenta? <a href="{{ route('register') }}"
                                            class="text-emerald-600 hover:text-emerald-700">Registrate</a>
                                    </p>
                                </div>
                            @else
                                <x-dropdown-link href="{{ route('profile.show') }}">
                                    Mi perfil
                                </x-dropdown-link>

                                <div class="border-t border-gray-200"></div>

                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            @endguest

                        </x-slot>
                    </x-dropdown>



                    <a href="{{ route('cart.index') }}" class="relative">
                        <i class="fas fa-shopping-cart text-white text-xl md:text-3xl"></i>
                        <span id="cart-count" class="absolute -top-2 -end-4 inline-flex w-6 h-6 items-center justify-center bg-red-600 rounded-full text-xs font-bold text-white" wire:model.live="cartUpdated">
                            {{ Cart::instance('shopping')->count() }}
                        </span>
                    </a>
                </div>
            </div>


            <div class="mt-4 md:hidden">
                <x-input oninput="search(this.value)" placeholder="Buscar por producto, tienda o marca"
                    class="w-full" />
            </div>
        </x-container>
    </header>

    <div x-show="open" x-on:click="open = false" class="fixed top-0 left-0 inset-0 bg-black bg-opacity-25 z-10"
        style="display: none;">
        <div class="fixed top-0 left-0 z-20">
            <div class="flex">
                <div class="w-screen md:w-80 h-screen bg-white">
                    <div class="bg-emerald-600 text-white font-semibold px-4 py-3">
                        <div class="flex justify-between items-center">
                            <span class="text-lg">Hola!</span>
                            <button x-on:click="open = false">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <div class="h-[calc(100vh-52px)] overflow-auto">
                        <ul>
                            @foreach ($families as $family)
                                <li wire:mouseover="$set('family_id', {{ $family->id }})">
                                    <a class="flex items-center justify-between  px-4 hover:px-6 py-3 text-gray-700 hover:bg-emerald-600 hover:text-white"
                                        href="{{ route('families.show', $family) }}">{{ $family->name }}
                                        <i class="fa-solid fa-angle-right"></i>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div x-show="open" class="w-80 xl:w-[57rem] pt-[52px] hidden md:block" style="display: none;">
                    <div class="h-[calc(100vh-52px)] overflow-auto bg-white px-6 py-8">
                        <div class="mb-8 flex justify-between items-center">
                            <p class="border-b-[3px] border-lime-400 uppercase text-xl font-semibold pb-1">
                                {{ $this->familyName }}
                            </p>

                            <a href="{{ route('families.show', $family_id) }}" class="btn btn-emerald">
                                Ver todo
                                <i class="fa-solid fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                        <ul class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                            @foreach ($this->categories as $category)
                                <li>
                                    <a href="{{ route('categories.show', $category) }}"
                                        class="text-lg font-semibold text-emerald-700 ">
                                        {{ $category->name }}
                                    </a>

                                    <ul class="mt-4 space-y-2">
                                        @foreach ($category->subcategories as $subcategory)
                                            <li>
                                                <a href="{{ route('subcategories.show', $subcategory) }}" class="text-sm text-gray-700 hover:text-emerald-700">
                                                    {{ $subcategory->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>


</div>
@push('js')
    <script>
        function search(value) {
            Livewire.dispatch('search', {
                search: value   
            })
        }

        Livewire.on('cartUpdated', (count ) => {
            document.getElementById('cart-count').innerText = count;
        })
    </script>
@endpush
