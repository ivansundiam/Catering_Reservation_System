@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 rounded-lg focus:border-primary focus:ring-primary-hover dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300  dark:focus:border-indigo-600 dark:focus:ring-indigo-600 shadow-sm disabled:bg-gray-200']) !!}>
