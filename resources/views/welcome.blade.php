<x-app-layout>
    @push('css')
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css"
        />
    @endpush


    <!-- Slider main container -->
<div class="swiper">
  <!-- Additional required wrapper -->
  <div class="swiper-wrapper">
    <!-- Slides -->
    @foreach ($covers as $cover)
        <div class="swiper-slide">
            <img src="{{ $cover->image }}" alt="" class="w-full aspect-[6/2] object-cover ">
        </div>
    @endforeach
  </div>
  <!-- If we need pagination -->
  <div class="swiper-pagination"></div>

  <!-- If we need navigation buttons -->
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
</div>

{{-- Last Products --}}
<x-container>
    <h1 class="text-2xl font-bold mb-4 mt-8 text-gray-800"> 
        Ultimos productos
    </h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($lastProducts as $product)
            <article class="bg-white rounded-lg shadow p-2 overflow-hidden">
                <img 
                    src="{{ $product->image }}" 
                    alt="{{ $product->name }}" 
                    class="w-full object-cover h-48 object-center rounded"
                >
                <div class="p-4">
                    <h1 class="text-lg font-bold text-gray-800 line-clamp-2 mb-2 min-h-[56px]">{{ $product->name }}</h1>
                    <p class="text-gray-600">$ {{ $product->price }}</p>
                </div>
                <a href="" class="btn btn-emerald block  w-full text-center">Ver Mas</a>
            </article>
        @endforeach
    </div>
</x-container>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
        <script>
            const swiper = new Swiper('.swiper', {
                loop: true,
                autoplay: {
                    delay: 5000,
                },
                pagination: {
                    el: '.swiper-pagination',
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                }
            });
        </script>
    @endpush
</x-app-layout>