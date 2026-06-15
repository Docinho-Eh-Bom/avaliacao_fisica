<x-secondary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'edit-result-{{ $result->id }}')">Editar</x-secondary-button>
<x-modal name="edit-result-{{ $result->id }}" focusable>
    <form method="POST" action="{{ route('results.update', $result) }}" class="p-6">
        @csrf
        @method('PATCH')

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Editar Resultado</h2>

        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ $result->testType->name }}</p>

        <div class="mt-6">
            <x-input-label for="value" value="Valor"/>

            <x-text-input
                id="value"
                name="value"
                type="number"
                step="0.01"
                class="mt-1 block w-full"
                :value="$result->value"
                required
            />

            <x-input-error :messages="$errors->get('value')" class="mt-2"/>
        </div>

        <div class="mt-6 flex justify-end gap-3">
            <x-secondary-button type="button" x-on:click="$dispatch( 'close-modal', 'edit-result-{{ $result->id }}')">Cancelar</x-secondary-button>

            <x-primary-button>Salvar</x-primary-button>
        </div>
    </form>
</x-modal>
