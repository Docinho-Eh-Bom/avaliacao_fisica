@props(['type' => 'success', 'message'])

@php
$styles = match($type){
    'success' => 'bg-green-100 dark:bg-green-800 border-green-500 text-green-800 dark:text-green-100',
    'error' => 'bg-red-100 dark:bg-red-800 border-red-500 text-red-800 dark:text-red-100',
    'warning' => 'bg-yellow-100 dark:bg-yellow-700 border-yellow-500 text-yellow-800 dark:text-yellow-100',
    default => 'bg-gray-100 dark:bg-gray-700 border-gray-500 text-gray-800 dark:text-gray-100',
};
@endphp

<div
    x-data="{ show: true }"
    x-init="setTimeout(() => show = false, 4000)"
    x-show="show"
    x-transition:enter="transform ease-out duration-300 transition"
    x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
    x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed bottom-5 right-5 z-50 w-full max-w-sm"
    style="display: none;"
>
    <div class="border-l-4 rounded-lg shadow-lg p-4 {{ $styles }}">
        <div class="flex items-start justify-between gap-4">

            <div class="text-sm font-medium">
                {{ $message }}
            </div>

            <button @click="show = false" class="text-lg leading-none opacity-70 hover:opacity-100">×</button>

        </div>
    </div>
</div>
