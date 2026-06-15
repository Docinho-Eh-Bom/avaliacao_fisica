<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <x-page-title>Histórico de Evolução</x-page-title>

            <a href="{{ route('students.show', $student) }}">
                <x-secondary-button>Voltar</x-secondary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto space-y-6">
            @foreach($historyCharts as $testName => $data)
                @include('students.partials.history-chart',
                    [
                        'testName' => $testName,
                        'data' => $data
                    ]
                )
            @endforeach
        </div>
    </div>
</x-app-layout>
