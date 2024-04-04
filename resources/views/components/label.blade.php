@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700 dark:text-gray-300']) }}>
    {{ $value ?? $slot }}
    @if($attributes->has('required'))
        <span class="text-base text-red-500"> *</span>
    @endif
</label>
