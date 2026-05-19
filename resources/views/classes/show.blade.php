<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <x-page-title>{{ $classGroup->name }}</x-page-title>

            <div class="flex gap-2">
                <a href="{{ route('classes.edit', $classGroup) }}">
                    <x-primary-button>Editar</x-primary-button>
                </a>

                <a href="{{ route('classes.index') }}">
                    <x-secondary-button>Voltar</x-secondary-button>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <x-section-card>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Nome da turma</p>

                    <h3 class="text-2xl font-bold dark:text-gray-100 mt-2">{{ $classGroup->name }}</h3>
                </x-section-card>

                <x-section-card>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Quantidade de alunos</p>

                    <h3 class="text-2xl font-bold dark:text-gray-100 mt-2">{{ $classGroup->students->count() }}</h3>
                </x-section-card>

                <x-section-card>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Descrição</p>

                    <p class="dark:text-gray-100 mt-2">{{ $classGroup->description ?: 'Sem descrição' }}</p>
                </x-section-card>

            </div>

            <x-section-card>
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-semibold dark:text-gray-100">Alunos da turma</h3>

                        <p class="text-sm text-gray-500 dark:text-gray-400">Lista de alunos vinculados</p>
                    </div>
                </div>

                <div class="overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium dark:text-gray-200">Nome</th>
                                <th class="px-6 py-3 text-left text-sm font-medium dark:text-gray-200">Idade</th>
                                <th class="px-6 py-3 text-right text-sm font-medium dark:text-gray-200">Ações</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($classGroup->students as $student)

                                <tr>
                                    <td class="px-6 py-4 dark:text-gray-100">{{ $student->name }}</td>
                                    <td class="px-6 py-4 dark:text-gray-300">{{ $student->age }} anos</td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end">
                                            <a href="{{ route('students.show', $student) }}">
                                                <x-secondary-button>Ver aluno</x-secondary-button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="3" class="px-6 py-8 text-center text-gray-400">
                                        Nenhum aluno nesta turma.
                                    </td>
                                </tr>

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </x-section-card>

        </div>
    </div>
</x-app-layout>
