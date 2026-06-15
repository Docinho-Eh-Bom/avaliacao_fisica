<div class="flex flex-wrap bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-y-auto mt-3" style="height: 750px">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 ">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th class="px-6 py-3 text-left dark:text-gray-200">Nome</th>
                <th class="px-6 py-3 text-left dark:text-gray-200"></th>
                <th class="px-6 py-3 text-left dark:text-gray-200"></th>
                <th class="px-6 py-3 text-left dark:text-gray-200">Turma</th>
                <th class="px-6 py-3 text-right dark:text-gray-200">Ações</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($students as $student)
                <tr>
                    <td class="px-6 py-4 dark:text-gray-100">{{ $student->name }}</td>
                    <td class="px-6 py-4 dark:text-gray-300"></td>
                    <td class="px-6 py-4 dark:text-gray-300"></td>
                    <td class="px-6 py-4 dark:text-gray-300">{{ $student->classGroup?->name ?? 'Sem turma' }}</td>
                    <td class="px-6 py-4">
                        <div class="flex justify-end gap-2">

                            <a href="{{ route('students.show', $student) }}">
                                <x-secondary-button>Ver</x-secondary-button>
                            </a>

                            <a href="{{ route('students.edit', $student) }}">
                                <x-primary-button>Editar</x-primary-button>
                            </a>

                            <form method="POST" action="{{ route('students.destroy', $student) }}">
                                @csrf
                                @method('DELETE')
                                <x-danger-button>Excluir</x-danger-button>
                            </form>

                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-400">Nenhum aluno cadastrado.</td>
                </tr>
            @endforelse

        </tbody>
    </table>
</div>
