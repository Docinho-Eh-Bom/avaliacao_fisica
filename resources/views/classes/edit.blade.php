<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <x-page-title>{{ $classGroup->name }}</x-page-title>

            <div class="flex gap-2">
                <a href="{{ route('classes.show', $classGroup) }}">
                    <x-primary-button>Voltar</x-primary-button>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-x1">
                    @include('classes.partials.class-form',[
                        'classGroup' => $classGroup,
                        'action' => route('classes.update', $classGroup),
                        'method' => 'PUT',
                        'formTitle' => 'Editar Turma',
                        'btnTitle' => 'Salvar'])
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                @include('classes.partials.class-student-manager',[
                    'formTitle' => 'Gerenciar Alunos'])
            </div>
        </div>
    </div>
</x-app-layout>
