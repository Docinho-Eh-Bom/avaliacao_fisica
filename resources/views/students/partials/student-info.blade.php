<x-section-card>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">Nome</p>
            <p class="mt-1 text-lg font-semibold dark:text-gray-100">{{ $student->name }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">Idade</p>
            <p class="mt-1 text-lg font-semibold dark:text-gray-100">{{ $student->age }} anos</p>
        </div>

        <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">Sexo</p>
            <p class="mt-1 text-lg font-semibold dark:text-gray-100">{{  $student->gender == 'M' ? 'Masculino' : 'Feminino' }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">Turma</p>
            <p class="mt-1 text-lg font-semibold dark:text-gray-100">{{ $student->classGroup?->name ?? 'Sem turma' }}</p>
        </div>
    </div>
</x-section-card>
