<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Categorias',
        'route' => route('admin.subcategories.index'),
    ],
    [
        'name' => 'Nueva Subcategoria',
    ],
]">

    {{-- <form action="{{ route('admin.subcategories.store') }}" method="POST">
        @csrf
        <div class="card">

            <x-validation-errors class="mb-4" />

            <div class="mb-4">
                <x-label class="mb-2">Categorias</x-label>
                <x-select class="w-full" name="category_id">
                    @foreach ($categories as $category)
                        <option @selected(old('category_id') == $category->id) value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="mb-4">
                <div class="mb-2">
                    <x-label class="mb-2">
                        Nombre
                    </x-label>
                    <x-input class="w-full" placeholder="Ingrese el nombre de la subcategoria" name="name"
                        value="{{ old('name') }}" />
                </div>
            </div>

            <div class="flex justify-end">
                <x-button>
                    Guardar
                </x-button>
            </div>
        </div>

    </form> --}}

    @livewire('admin.subcategories.subcategory-create')
</x-admin-layout>
