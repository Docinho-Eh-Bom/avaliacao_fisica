<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Criar Aluno</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form action="{{ route('students.store') }}" method="POST">
                @csrf

                <div>
                    <label>Nome:</label>
                    <input type="text" name="name" required class="border">
                </div>

                <div class="mt-2">
                    <label>Sexo:</label>
                    <select name="gender" required class="border">
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                    </select>
                </div>

                <div class="mt-2">
                    <label>Data de nascimento:</label>
                    <input type="date" name="birth_date" required class="border">
                </div>

                <div class="mt-2">
                    <label>Turma:</label>
                    <select name="class_group_id" class="border">
                        <option value="">Sem turma</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}">
                                {{ $class->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-4">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2">
                        Salvar
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
