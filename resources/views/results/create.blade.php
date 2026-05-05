<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            Adicionar Resultado
        </h2>
    </x-slot>

    <div class="p-6">

        <form action="{{ route('batteries.results.store', $battery) }}" method="POST">
            @csrf

            <div>
                <label>Teste:</label>
                <select name="test_type_id" class="border">
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">
                            {{ $type->name }} ({{ $type->unit }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mt-2">
                <label>Valor:</label>
                <input type="number" step="0.01" name="value" class="border">
            </div>

            <button class="mt-4 bg-blue-500 text-white px-4 py-2">
                Salvar
            </button>
        </form>

    </div>
</x-app-layout>
