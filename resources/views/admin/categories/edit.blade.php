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
        'name' => $category->name,
    ],
]">

    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
        @csrf

        @method('PUT')
        <div class="card">

            <x-validation-errors class="mb-4" />

            <div class="mb-4">
                <x-label class="mb-2">Familia</x-label>
                <x-select class="w-full" name="family_id">
                    @foreach ($families as $family)
                        <option @selected(old('family_id', $category->family_id) == $family->id) value="{{$family->id}}">{{$family->name}}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="mb-4">
                <div class="mb-2">
                    <x-label class="mb-2">
                        Nombre
                    </x-label>
                    <x-input class="w-full" placeholder="Ingrese el nombre de la categoria" name="name"
                        value="{{ old('name', $category->name) }}" />
                </div>
            </div>


            <div class="flex justify-end">
                <x-danger-button onclick="confirmDelete()">
                    Eliminar
                </x-danger-button>

                <x-button class="ml-2">
                    Editar
                </x-button>
            </div>
        </div>

    </form>

    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" id="delete-form">
        @csrf
        @method('DELETE')
    </form>

    @push('js')
    <script>
        function confirmDelete() {
            Swal.fire({
                title: "Estas Seguro?",
                text: "no podras revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, Borrar!",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form').submit();
                }
            });
        }
    </script>
@endpush

</x-admin-layout>
