<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">

            <x-page-title>{{ $student->name }}</x-page-title>

            <div class="flex gap-2">
                <a href="{{ route('students.edit', $student) }}">
                    <x-primary-button>Editar</x-primary-button>
                </a>

                <a href="{{ route('students.index') }}">
                    <x-secondary-button>Voltar</x-secondary-button>
                </a>

            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @include('students.partials.student-info')
            @include('students.partials.student-batteries')
        </div>
    </div>

</x-app-layout>
