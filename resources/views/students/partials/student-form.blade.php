<section>
    <header>
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
            <x-input-label for="name" :value="__('Nome')"/>
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $student->name ?? '')"/>
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div id="gender_input">
            <x-input-label for="gender" :value="__('Sexo')"/>
            <x-select-input name="gender" class="block mt-1 w-full">
                <option value="M" @selected(old('gender', $student->gender ?? '') == 'M')>Masculino</option>
                <option value="F" @selected(old('gender', $student->gender ?? '') == 'F')>Feminino</option>
            <x-input-error class="mt-2" :messages="$errors->get('gender')" />
            </x-select-input>
        </div>

        <div id="birth_date_input">
            <x-input-label for="birth_date" :value="__('Data de Nascimento')"/>
            <x-date-input
                name="birth_date"
                class="block mt-1 w-full"
                :value="old('birth_date', isset($student) ? $student->birth_date?->format('Y-m-d') : '')"/>
            <x-input-error class="mt-2" :messages="$errors->get('birth_date')" />
        </div>

        <div id="class_input">
            <x-input-label for="class_group_id" :value="__('Turma')"/>
            <x-select-input name="class_group_id" class="block mt-1 w-full">
                <option value="">Sem turma</option>
                @foreach ($classes as $class)
                    <option value="{{ $class->id }}"
                    @selected(old('class_group_id',$student->class_group_id ?? '') == $class->id)>
                        {{ $class->name }}
                    </option>
                @endforeach
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('class_group_id')" />
        </div>

        <x-primary-button>{{ $btnTitle }}</x-primary-button>
    </form>
</section>
