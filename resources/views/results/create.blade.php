<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <x-page-title>Inserir Resultados</x-page-title>

            <a href="{{ route('batteries.show', $battery) }}">
                <x-secondary-button>Voltar</x-secondary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <x-section-card>
                <div class="mb-6">
                    <h3 class="text-lg font-semibold dark:text-gray-100">{{ $battery->student->name }}</h3>

                    <p class="text-sm text-gray-500 dark:text-gray-400">Bateria {{ $battery->year }}</p>
                </div>

                <form method="POST" action="{{ route('batteries.results.store', $battery) }}" class="space-y-6">
                    @csrf

                    <div class="overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-medium dark:text-gray-200">Teste</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium dark:text-gray-200">Unidade</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium dark:text-gray-200">Resultado</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($types as $type)

                                    <tr>
                                        <td class="px-6 py-4 dark:text-gray-100">{{ $type->name }}</td>

                                        <td class="px-6 py-4 dark:text-gray-300">{{ $type->unit ?? '-' }}</td>

                                        <td class="px-6 py-4">
                                            <x-text-input type="number" step="0.01" name="results[{{ $type->id }}]" class="w-full"/>
                                        </td>
                                    </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    <div class="flex justify-end">
                        <x-primary-button>Salvar resultados</x-primary-button>
                    </div>
                </form>
            </x-section-card>
        </div>
    </div>
</x-app-layout>
