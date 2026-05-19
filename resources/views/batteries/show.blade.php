<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">

            <x-page-title>Bateria {{ $battery->year }}</x-page-title>

            <a href="{{ route('students.show', $battery->student) }}">
                <x-secondary-button>Voltar ao aluno</x-secondary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <x-stat-card title="Aluno" :value="$battery->student->name"/>
                <x-stat-card title="Ano" :value="$battery->year"/>
                <x-stat-card title="Testes" :value="$battery->results->count()"/>
            </div>

            <x-section-card>
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-semibold dark:text-gray-100">Resultados</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Testes cadastrados nesta bateria</p>
                    </div>

                    <a href="{{ route('batteries.results.create', $battery) }}">
                        <x-primary-button>Adicionar resultado</x-primary-button>
                    </a>
                </div>

                <div class="overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700">

                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium dark:text-gray-200">Teste</th>
                                <th class="px-6 py-3 text-left text-sm font-medium dark:text-gray-200">Resultado</th>
                                <th class="px-6 py-3 text-left text-sm font-medium dark:text-gray-200">Unidade</th>
                                <th class="px-6 py-3 text-left text-sm font-medium dark:text-gray-200">Avaliação</th>
                                <th class="px-6 py-3 text-right text-sm font-medium dark:text-gray-200">Ações</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($battery->results as $result)
                                <tr>
                                    <td class="px-6 py-4 dark:text-gray-100">{{ $result->testType->name }}</td>
                                    <td class="px-6 py-4 dark:text-gray-300">{{ $result->value }}</td>
                                    <td class="px-6 py-4 dark:text-gray-300">{{ $result->testType->unit ?? '-' }}</td>

                                    <td class="px-6 py-4">
                                        @php
                                            $evaluation = $evaluations[$result->id] ?? null;
                                        @endphp

                                        @if($evaluation && $evaluation['classification'])
                                            <span class="px-3 py-1 rounded-full text-sm bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300">
                                                {{ $evaluation['classification'] }}
                                            </span>
                                        @else
                                            <span class="text-gray-400">Não avaliado</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex justify-end gap-2">
                                            <form method="POST" action="{{ route('results.destroy', $result) }}">
                                                @csrf
                                                @method('DELETE')

                                                <x-danger-button>Excluir</x-danger-button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-400">Nenhum resultado cadastrado.</td>
                                </tr>

                            @endforelse

                        </tbody>
                    </table>
                </div>
            </x-section-card>

        </div>
    </div>
</x-app-layout>
