<x-app-layout>
    <x-slot name="header">
        <x-page-title>Comparação de Avaliações</x-page-title>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                @include('comparison.partials.comparison-filter')

                    @if($comparison->count())
                    @include('comparison.partials.comparison-summary')
            </div>
                @include('comparison.partials.comparison-table')

                @include('comparison.partials.comparison-chart')
            @endif
        </div>
    </div>
</x-app-layout>
