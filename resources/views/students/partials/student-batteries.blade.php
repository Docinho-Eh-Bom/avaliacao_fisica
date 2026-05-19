<x-section-card>
    <div class="flex items-center justify-between mb-6">

        <h3 class="text-lg font-semibold dark:text-gray-100">Histórico de baterias</h3>

        <a href="#">
            <x-primary-button>Nova bateria</x-primary-button>
        </a>

    </div>

    <div class="overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium dark:text-gray-200">Bateria Criada em</th>
                    <th class="px-6 py-3 text-left text-sm font-medium dark:text-gray-200">Testes</th>
                    <th class="px-6 py-3 text-right text-sm font-medium dark:text-gray-200">Ações</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($student->batteries as $battery)
                    <tr>
                        <td class="px-6 py-4 dark:text-gray-100">{{ $battery->created_at->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 dark:text-gray-300">{{ $battery->results->count() }} testes</td>
                        <td class="px-6 py-4 flex justify-end gap-2">

                            <a href="{{ route('batteries.show', $battery) }}">
                                <x-secondary-button>Ver</x-secondary-button>
                            </a>
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="3" class="px-6 py-8 text-center text-gray-400">
                            Nenhuma bateria cadastrada.
                        </td>
                    </tr>

                @endforelse
            </tbody>
        </table>
    </div>
</x-section-card>
