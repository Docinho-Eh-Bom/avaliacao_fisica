<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            Bateria {{ $battery->year }}
        </h2>
    </x-slot>

    <div class="p-6">

        <a href="{{ route('batteries.results.create', $battery) }}"
           class="text-blue-500">
            Adicionar resultado
        </a>

        <ul class="mt-4 space-y-2">
            @forelse ($battery->results as $result)
                <li>
                    {{ $result->testType->name }} -
                    {{ $result->value }}
                </li>
            @empty
                <li class="text-gray-500">
                    Nenhum resultado ainda.
                </li>
            @endforelse
        </ul>

    </div>
</x-app-layout>
