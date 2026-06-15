<form method="GET" class="mb-6 flex flex-wrap gap-4 items-end">
    <div>
        <label class="block text-sm font-medium text-white">Turma</label>

        <select name="class_group_id" class="rounded-md border-gray-300">
            <option value="">Todas</option>

            @foreach($classes as $class)
                <option
                    value="{{ $class->id }}"
                    @selected(request('class_group_id') == $class->id)
                >
                    {{ $class->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-white">Sexo</label>

        <select name="gender" class="rounded-md border-gray-300">
            <option value="">Todos</option>

            <option value="M"  @selected(request('gender') === 'M')>Masculino</option>

            <option value="F" @selected(request('gender') === 'F')>
                Feminino</option>
        </select>
    </div>

    <div class="gap-2">
        <x-primary-button>Filtrar</x-primary-button>

        <a href="{{ route('students.index') }}">
            <x-secondary-button type="button">Limpar</x-secondary-button>
        </a>
    </div>
</form>
