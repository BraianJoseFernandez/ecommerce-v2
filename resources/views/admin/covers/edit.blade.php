<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Portadas',
        'route' => route('admin.covers.index'),
    
    ],  
    [
        'name' => 'Editar Portada',
    ]
]">

<form action="{{ route('admin.covers.update', $cover) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <figure class="relative">
        <div class="absolute top-8 right-8">
            <label class="flex items-center px-4 py-2 bg-gray-700 text-white rounded-full cursor-pointer">
                <i class="fas fa-camera mr-2"></i>
                Actualizar imagen
                <input type="file" class="hidden" accept="image/*" name="image" onchange="previewImage(event, '#img-preview')">
            </label>
        </div>
        <img src="{{ $cover->image }}" alt="Portada" class="w-full aspect-[3/1] object-cover object-center" id="img-preview">
    </figure>

    <x-validation-errors class="mb-4" />

    <div class="mb-4 mt-4">
        <x-label>Titulo</x-label>
        <x-input name="title" value="{{ old('title', $cover->title) }}" class="w-full"  placeholder="Ingresa el titulo de la portada"/>
    </div>

    <div class="mb-4 mt-4">
        <x-label>Fecha de Inicio</x-label>
        <x-input type="date" name="start_at" value="{{ old('start_at', $cover->start_at->format('Y-m-d')) }}" class="w-full" />
    </div>

    <div class="mb-4 mt-4">
        <x-label>Fecha de Finalizacion (opcional)</x-label>
        <x-input type="date" name="end_at" value="{{ old('end_at', $cover->end_at ? $cover->end_at->format('Y-m-d') : '' ) }}" class="w-full" />
    </div>

    <div class="mb-4 flex space-x-2">
        <label> 
            <x-input type="radio" name="is_active" value="1" :checked="$cover->is_active == 1" />
            Activo
        </label>
        <label> 
            <x-input type="radio" name="is_active" value="0" :checked="$cover->is_active == 0" />
            Inactivo
    </div>

    <div class="flex justify-end mt-6">
        <x-button>Actualizar Portada</x-button>
    </div>
</form>


@push('js')
    <script>
        function previewImage(event, querySelector){

        //Recuperamos el input que desencadeno la acción
        let input = event.target;
        
        //Recuperamos la etiqueta img donde cargaremos la imagen
        let imgPreview = document.querySelector(querySelector);

        // Verificamos si existe una imagen seleccionada
        if(!input.files.length) return
        
        //Recuperamos el archivo subido
        let file = input.files[0];

        //Creamos la url
        let objectURL = URL.createObjectURL(file);
        
        //Modificamos el atributo src de la etiqueta img
        imgPreview.src = objectURL;
                
        }
    </script>
@endpush


</x-admin-layout>