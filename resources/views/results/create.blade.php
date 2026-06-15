<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <x-page-title>Adicionar Resultados</x-page-title>

            <a href="{{ route('batteries.show', $battery) }}">
                <x-secondary-button>Voltar</x-secondary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <x-section-card>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Aluno</p>

                    <h3 class="text-2xl font-bold dark:text-gray-100 mt-2">{{ $battery->student->name }}</h3>
                </x-section-card>

                <x-section-card>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Ano</p>

                    <h3 class="text-2xl font-bold dark:text-gray-100 mt-2">{{ $battery->year }}</h3>
                </x-section-card>

                <x-section-card>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Testes disponíveis</p>

                    <h3 class="text-2xl font-bold dark:text-gray-100 mt-2">{{ $types->count() }}</h3>
                </x-section-card>
            </div>

            <x-section-card>
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
                                @forelse($types as $type)
                                    <tr>
                                        <td class="px-6 py-4 dark:text-gray-100">{{ $type->name }}</td>

                                        <td class="px-6 py-4 dark:text-gray-300">{{ $type->unit }}</td>

                                        <td class="px-6 py-4">
                                            <input
                                                type="hidden"
                                                name="results[{{ $type->id }}][test_type_id]"
                                                value="{{ $type->id }}">
                                            <input
                                                type="number"
                                                step="0.01"
                                                name="results[{{ $type->id }}][value]"
                                                value="{{ old('results.' . $type->id . '.value') }}"
                                                class="w-full rounded-md border-gray-300 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100">
                                        </td>
                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="3" class="px-6 py-8 text-center text-gray-400">Nenhum teste ativo disponível.</td>
                                    </tr>

                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="flex justify-end">
                        <x-primary-button>Salvar Resultados</x-primary-button>
                    </div>
                </form>
            </x-section-card>
        </div>
    </div>
</x-app-layout>
