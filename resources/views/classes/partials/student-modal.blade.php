<x-secondary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-students')">Adicionar alunos</x-secondary-button>
<x-modal name="add-students" focusable>
    <form method="POST" action="{{ route('classes.students.update', $classGroup) }}" class="p-6">
        @csrf
        @method('PUT')

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Adicionar alunos à turma</h2>

        <div class="mt-6 max-h-72 overflow-y-auto space-y-3">
            @forelse($availableStudents as $student)
                <label class="flex items-center gap-3">
                    <input
                        type="checkbox"
                        name="new_students[]"
                        value="{{ $student->id }}"
                        class="rounded border-gray-300">

                    <span class="dark:text-gray-100">{{ $student->name }}</span>
                </label>

            @empty

                <p class="text-gray-400">Nenhum aluno disponível.</p>

            @endforelse

        </div>
        <div class="m-2 flex justify-end gap-3">
            <x-secondary-button x-on:click="$dispatch('close-modal', 'add-students')" type="button">Cancelar</x-secondary-button>
            <x-primary-button>Adicionar</x-primary-button>
        </div>
    </form>
</x-modal>
