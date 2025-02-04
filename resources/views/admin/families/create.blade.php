<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Familias',
        'route' => route('admin.families.index'),
    ],
    [
        'name' => 'Nueva familia',
    ],
]">

    <div class="card">
        <x-validation-errors class="mb-4" />
        <form action="{{route('admin.families.store')}}" method="POST">
            @csrf

            <div class="mb-4">
                <x-label class="mb-2">
                    Nombre
                </x-label>
                <input class="w-full" placeholder="Ingrese el nombre de la familia" name="name" value="{{old('name')}}"/>

            </div>
            <div class="flex justify-end">
                <x-button>
                    Guardar
                </x-button>
            </div>
        </form>
    </div>

</x-admin-layout>
