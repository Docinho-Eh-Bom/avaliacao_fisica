<x-app-layout>
    <x-slot name="header">
        <x-page-title>Turmas</x-page-title>
    </x-slot>


    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('classes.create') }}">
                <x-primary-button>Adicionar Turma</x-primary-button>
            </a>

            @include('classes.partials.show-class')
        </div>
    </div>
</x-app-layout>
