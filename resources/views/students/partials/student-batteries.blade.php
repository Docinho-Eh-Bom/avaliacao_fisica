<x-section-card>
    <div class="flex items-center justify-between mb-6">

        <h3 class="text-lg font-semibold dark:text-gray-100">Histórico de baterias</h3>

        <x-secondary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-battery')">Nova bateria</x-secondary-button>

        <x-modal name="create-battery" focusable>
            <form method="POST" action="{{ route('students.batteries.store', $student) }}" class="p-6 space-y-6">
                @csrf
                <div>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Criar nova bateria</h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Informe o ano da avaliação.</p>
                </div>

                <div>
                    <x-input-label for="year" value="Ano" />

                    <x-text-input id="year" name="year" type="number" class="mt-1 block w-full" :value="old('year', now()->year)" required/>

                    <x-input-error class="mt-2" :messages="$errors->get('year')"/>
                </div>

                <div class="flex justify-end gap-3">
                    <x-secondary-button type="button" x-on:click="$dispatch('close')">Cancelar</x-secondary-button>
                    <x-primary-button>Criar bateria</x-primary-button>
                </div>
            </form>
        </x-modal>

    </div>

    <div class="overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium dark:text-gray-200">Ano</th>
                    <th class="px-6 py-3 text-left text-sm font-medium dark:text-gray-200">Testes</th>
                    <th class="px-6 py-3 text-right text-sm font-medium dark:text-gray-200">Ações</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($student->batteries as $battery)
                    <tr>
                        <td class="px-6 py-4 dark:text-gray-100">{{ $battery->year }}</td>
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
