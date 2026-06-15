<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <x-section-card>
        <p class="text-white">Total de Alunos inseridos no sistema:</p>

        <p class="text-4xl font-bold text-gray-400">
            {{ $studentCount }}
        </p>
    </x-section-card>

    <x-section-card>
        <p class="text-white">Total de Turmas inseridas no sistema:</p>

        <p class="text-4xl font-bold text-gray-400">
            {{ $classCount }}
        </p>
    </x-section-card>
</div>
