<x-app-layout>
    <x-slot name="header">
        <h2>Alunos</h2>
    </x-slot>

    <div class="p-6">
        <a href="{{ route('students.create') }}">Adicionar Aluno</a>

        <ul>
            @foreach ($students as $student)
                <li>
                    <a href="{{ route('students.show', $student) }}">
                        {{ $student->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
