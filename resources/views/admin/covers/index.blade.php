<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Portadas',
    ],
]">

    <x-slot name="action">
        <a href="{{ route('admin.covers.create') }}" class="btn btn-blue">Nuevo</a>
    </x-slot>

    <ul class="space-y-2" id="covers">
        @foreach ($covers as $cover)
            <li class="bg-white rounded-lg shadow-lg p-4 lg:flex overflow-hidden cursor-move" data-id="{{ $cover->id }}"> 
                <img src="{{ $cover->image }}" alt="{{ $cover->title }}" class="lg:w-64 w-full aspect-[3/1] object-cover">
                <div class="lg:p-4 lg:flex-1 lg:flex lg:justify-between lg:items-center p-4 space-y-3 lg:space-y-0">
                    <div >
                        <h1 class="font-semibold">
                            {{ $cover->title }}
                        </h1>
                        <p>
                            @if ($cover->is_active)
                                <span class="inline-flex items-center rounded-md bg-green-400/10 px-2 py-1 text-xs font-medium text-green-400 inset-ring inset-ring-green-500/20">Activo</span>
                            @else
                                <span class="inline-flex items-center rounded-md bg-red-400/10 px-2 py-1 text-xs font-medium text-red-400 inset-ring inset-ring-red-400/20">Inactivo</span>
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-bold">Fecha de inicio</p>
                        <p>
                            {{ $cover->start_at->format('d/m/Y') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-bold">Fecha de finalizacion</p>
                        <p>
                            {{ $cover->end_at ?  $cover->end_at->format('d/m/Y') : '-'}}
                        </p>
                    </div>
                    <div>
                        <a href="{{ route('admin.covers.edit', $cover) }}" class="btn btn-blue">
                            Editar
                        </a>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>

    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.6/Sortable.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script>
            new Sortable(covers, {
                animation: 150,
                ghostClass: 'bg-blue-200',
                store: {
                    set: (sortable) => {
                        const sorts = sortable.toArray();
                        axios.post('{{ route("api.sort.covers") }}', {
                            sorts: sorts
                        }).catch(error => {
                            console.log(error);
                        });
                    }
                }
            });
        </script>
    @endpush

</x-admin-layout>