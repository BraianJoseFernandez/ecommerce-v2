<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Categorias',
        'route' => route('admin.categories.index'),
    ],
    [
        'name' => 'Nueva Categoria',
    ],
]">

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="card">

            <x-validation-errors class="mb-4" />

            <div class="mb-4">
                <x-label class="mb-2">Familia</x-label>
                <x-select class="w-full" name="family_id">
                    @foreach ($families as $family)
                        <option @selected(old('family_id') == $family->id) value="{{$family->id}}">{{$family->name}}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="mb-4">
                <div class="mb-2">
                    <x-label class="mb-2">
                        Nombre
                    </x-label>
                    <x-input class="w-full" placeholder="Ingrese el nombre de la categoria" name="name"
                        value="{{ old('name') }}" />
                </div>
            </div>

            <div class="flex justify-end">
                <x-button>
                    Guardar
                </x-button>
            </div>
        </div>

    </form>

</x-admin-layout>
