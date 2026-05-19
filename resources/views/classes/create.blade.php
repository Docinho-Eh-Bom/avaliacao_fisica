<x-app-layout>
    <x-slot name="header">
        <x-page-title>
            {{ __('Turma') }}
        </x-page-title>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-x1">
                    @include('classes.partials.class-form',[
                        'action' => route('classes.store'),
                        'method' => 'POST',
                        'formTitle' => 'Criar Turma',
                        'btnTitle' => 'Criar'])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
