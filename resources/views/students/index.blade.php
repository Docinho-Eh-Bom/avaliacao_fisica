<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Alunos</h2>
    </x-slot>


    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <a href="{{ route('students.create') }}" class="text-blue-500">
                Adicionar Aluno
            </a>

            <ul class="mt-4 space-y-2">
                @forelse ($students as $student)
                    <li>
                        <a href="{{ route('students.show', $student) }}" class="text-white">
                            {{ $student->name }}
                        </a>
                    </li>
                @empty
                    <li class="text-gray-500">
                        Nenhum aluno cadastrado.
                    </li>
                @endforelse
            </ul>

        </div>
    </div>
</x-app-layout>
