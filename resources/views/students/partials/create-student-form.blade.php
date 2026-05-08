<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Inserir Aluno') }}
        </h2>
    </header>

    <form method="post" action="{{ route('students.store') }}" class="mt-6 space-y-6">
        @csrf

        <div id="name_input">
            <x-input-label for="name" :value="__('Nome')"/>
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"/>
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div id="gender_input">
            <x-input-label for="gender" :value="__('Sexo')"/>
            <x-select-input name="gender" class="block mt-1 w-full">
                <option value="M">Masculino</option>
                <option value="M">Feminino</option>
            <x-input-error class="mt-2" :messages="$errors->get('gender')" />
            </x-select-input>
        </div>

        <div id="birth_date_input">
            <x-input-label for="birth_date" :value="__('Data de Nascimento')"/>
            <x-date-input
                name="birth_date"
                class="block mt-1 w-full"
                :value="old('birth_date')"/>
            <x-input-error class="mt-2" :messages="$errors->get('birth_date')" />
        </div>

        <div id="class_input">
            <x-input-label for="class_group_id" :value="__('Turma')"/>
            <x-select-input name="class_group_id" class="block mt-1 w-full">
                <option value="">Sem turma</option>
                @foreach ($classes as $class)
                    <option value="{{ $class->id }}">
                        {{ $class->name }}
                    </option>
                @endforeach
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('class_group_id')" />
        </div>

        <x-primary-button>{{ __('Salvar') }}</x-primary-button>
    </form>
</section>
