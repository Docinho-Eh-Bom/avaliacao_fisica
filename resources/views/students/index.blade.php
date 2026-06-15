<x-app-layout>
    <x-slot name="header">
        <x-page-title>Alunos</x-page-title>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<!--             <x-section-card>
                @include('students.partials.student-filter')
            </x-section-card> -->
            <a href="{{ route('students.create') }}">
                    <x-primary-button>Adicionar Aluno</x-primary-button>
            </a>
            @include('students.partials.show-student')
        </div>
    </div>
</x-app-layout>


