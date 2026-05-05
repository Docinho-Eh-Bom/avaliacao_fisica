<x-app-layout>
    <x-slot name="header">
        <h2>Criar Bateria</h2>
    </x-slot>

    <div class="p-6">
        <form action="{{ route('students.batteries.store', $student) }}" method="POST">
            @csrf

            <label>Ano:</label>
            <input type="number" name="year" class="border">

            <button class="bg-blue-500 text-white px-4 py-2 mt-2">
                Salvar
            </button>
        </form>
    </div>
</x-app-layout>
