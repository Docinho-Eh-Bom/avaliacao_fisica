<section>
    <header class="flex flex-row justify-between">
        <x-page-title>
            {{ $formTitle }}
        </x-page-title>
    </header>

    <form method="post" action="{{ $action }}" class="mt-6 space-y-6">
        @csrf

        @if($method !== 'POST')
            @method($method)
        @endif

        <div id="name_input">
            <x-input-label for="name" :value="__('Nome da Turma')"/>
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $classGroup->name ?? '')"/>
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div id="desc_input">
            <x-input-label for="description" :value="__('Descrição')"/>
            <textarea name="description" id="description">{{ old('description', $classGroup->description ?? '') }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <!-- Old add student -->
        @if($method === 'POST')
            <div id="student_input">
                <x-input-label for="students" value="Alunos"/>

                <div class="mt-2 space-y-2 max-h-64 overflow-y-auto">
                    @foreach($allStudents as $student)
                        <label class="flex items-center gap-2">
                            <input
                                type="checkbox"
                                name="students[]"
                                value="{{ $student->id }}">

                            <span class="dark:text-gray-100">{{ $student->name }}</span>
                        </label>

                    @endforeach
                </div>
            </div>
        @endif

        <x-primary-button>{{ $btnTitle }}</x-primary-button>
    </form>
</section>
