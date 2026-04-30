<form action="{{ route('batteries.results.store', $battery) }}" method="POST">
    @csrf

    <select name="test_type_id">
        @foreach ($types as $type)
            <option value="{{ $type->id }}">
                {{ $type->name }}
            </option>
        @endforeach
    </select>

    <input type="number" step="0.01" name="value">

    <button type="submit">Salvar</button>
</form>
