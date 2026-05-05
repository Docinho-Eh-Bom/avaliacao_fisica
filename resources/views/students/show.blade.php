<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ $student->name }}</h2>
    </x-slot>

    <div class="p-6 space-y-4">
        <div>
            <p><strong>Idade:</strong>{{ $student->age }}</p>
            <p><strong>Sexo:</strong>{{ $student->gender }}</p>
        </div>

        <div>
            <a href="{{ route('students.batteries.create', $student) }}" class="text-blue-500"> Adicionar bateria de testes</a>
        </div>

        <div>
            <h3 class="font-semibold">Baterias</h3>

            <ul class="mt-2 space-y-2">
                @forelse ($student->batteries as $battery)
                    <li>
                        <a href="{{ route('batteries.show', $battery) }}" class="text-blue-600"> {{ $battery->year }}</a>
                    </li>
                @empty
                    <li class="text-gray-500">Nenhuma bateria cadastrada</li>
                @endforelse
            </ul>
        </div>
    </div>
</x-app-layout>
