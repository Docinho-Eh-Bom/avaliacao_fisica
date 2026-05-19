@props(['title','value'])

<div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">

    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $title }}</p>

    <h3 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-2">{{ $value }}</h3>

    {{ $slot }}

</div>
