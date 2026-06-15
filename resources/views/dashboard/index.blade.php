<x-app-layout>
    <x-slot name="header">
        <x-page-title>Dashboard</x-page-title>
    </x-slot>

    <div class="py-6">
        <div class="w-full max-w-7xl mx-auto space-y-6 px-4">
            @include('dashboard.partials.stats-cards')

            <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 gap-6">
                @include('dashboard.partials.students-without-class')

                @include('dashboard.partials.students-without-battery')
            </div>

            <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 gap-6">
                @include('dashboard.partials.class-chart')

                @include('dashboard.partials.year-chart')
            </div>
        </div>
    </div>
</x-app-layout>
