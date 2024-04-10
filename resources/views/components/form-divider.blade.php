@props(['value' => null])

<div class="flex items-center justify-center w-full my-5">
    <div class="h-[2px] bg-gray-500 grow"></div>
    @if ($value)
        <h2 class="mx-4 text-md md:text-xl font-noticia">{{ $value }}</h2>
    @endif
    <div class="h-[2px] bg-gray-500 grow"></div>
</div>