<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <x-page-title>Tipos de Teste</x-page-title>

            <a href="{{ route('test-types.create') }}">
                <x-primary-button>Novo teste</x-primary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-section-card>
                <div class="overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium dark:text-gray-200">Nome</th>
                                <th class="px-6 py-3 text-left text-sm font-medium dark:text-gray-200"></th>
                                <th class="px-6 py-3 text-left text-sm font-medium dark:text-gray-200"></th>
                                <th class="px-6 py-3 text-left text-sm font-medium dark:text-gray-200">Status</th>
                                <th class="px-6 py-3 text-right text-sm font-medium dark:text-gray-200">Ações</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($types as $type)

                                <tr>
                                    <td class="px-6 py-4 dark:text-gray-100">{{ $type->name }}</td>
                                    <td class="px-6 py-4 dark:text-gray-300"></td>
                                    <td class="px-6 py-4 dark:text-gray-300"></td>
                                    <td class="px-6 py-4">
                                        @if($type->is_active)
                                            <span class="px-3 py-1 rounded-full text-sm bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300">Ativo</span>

                                        @else

                                            <span class="px-3 py-1 rounded-full text-sm bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300">Inativo</span>

                                        @endif
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('test-types.show', $type) }}">
                                                <x-secondary-button>Ver</x-secondary-button>
                                            </a>

<!--         Maybe i put a edit? idk                                    <a href="{{ route('test-types.edit', $type) }}">
                                                <x-primary-button>Editar</x-primary-button>
                                            </a> -->

                                        </div>
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-400">Nenhum tipo de teste cadastrado.</td>
                                </tr>

                            @endforelse

                        </tbody>
                    </table>
                </div>
            </x-section-card>
        </div>
    </div>
</x-app-layout>
