<x-section-card>
    <form method="GET">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block mb-2 text-white">Primeira bateria</label>

                <select name="battery1" class="w-full rounded">
                    @foreach($batteries as $battery)
                        <option
                            value="{{ $battery->id }}"
                            @selected(request('battery1') == $battery->id)>
                            {{ $battery->year }}
                        </option>

                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-2 text-white">Segunda bateria</label>
                <select name="battery2" class="w-full rounded">
                    @foreach($batteries as $battery)
                        <option
                            value="{{ $battery->id }}"
                            @selected( request('battery2')== $battery->id)>
                            {{ $battery->year }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mt-4">
            <x-primary-button>Comparar</x-primary-button>
            <a href="{{ route('students.show', $battery->student) }}">
                <x-secondary-button>Voltar</x-secondary-button>
            </a>
        </div>
    </form>
</x-section-card>
