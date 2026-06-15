<section>
    <header class="flex flex-row justify-between">
        <x-page-title>
            {{ $formTitle }}
        </x-page-title>
        @include('classes.partials.student-modal')
    </header>

    <form method="POST" action="{{ route('classes.students.update', $classGroup) }}" class="mt-6 space-y-4">
        @csrf
        @method('PUT')

        @forelse($students as $student)
            <div class="flex items-center justify-between bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                <div>
                    <p class="font-medium dark:text-gray-100">{{ $student->name }}</p>

                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $student->age }} anos</p>
                </div>

                <div>
                    <x-select-input name="students[{{ $student->id }}]">
                        <option value="">Remover da Turma</option>
                        @foreach($classes as $class)
                            <option
                                value="{{ $class->id }}"
                                @selected($student->class_group_id == $class->id)>
                                {{ $class->name }}
                            </option>
                        @endforeach
                    </x-select-input>

                </div>
            </div>

        @empty

            <p class="text-gray-400">Nenhum aluno nesta turma.</p>

        @endforelse

        <div class="flex justify-end">
            <x-primary-button>Salvar alterações</x-primary-button>
        </div>
    </form>
</section>
