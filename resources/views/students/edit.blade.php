<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $student->name }}
            </h2>

            <a href="{{ route('students.show', $student) }}">
                <x-secondary-button style="margin-bottom: 0px;" >Voltar ao aluno</x-secondary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-x1">
                    @include('students.partials.student-form',[
                        'student' => $student,
                        'action' => route('students.update', $student),
                        'method' => 'PUT',
                        'formTitle' => 'Editar Aluno',
                        'btnTitle' => 'Salvar'])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
