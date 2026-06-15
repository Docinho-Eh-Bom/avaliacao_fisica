<x-section-card>
    <h2 class="font-bold text-lg mb-4 text-white">Comparação Detalhada</h2>

    <table class="w-full">
        <thead>
            <tr>
                <th class="text-left text-white">Teste</th>
                <th class="text-center text-white">Resultado</th>
                <th class="text-center text-white">Classificação</th>
                <th class="text-right text-white">Evolução</th>
            </tr>
        </thead>

        <tbody>
            @foreach($comparison as $item)
                <tr class="border-b text-white">
                    <td>{{ $item['test'] }}</td>

                    <td class="text-center text-white">
                        {{ $item['old_value'] }} → {{ $item['new_value'] }} {{ $item['unit'] }}
                    </td>

                    <td class="text-center text-white">
                        {{ $item['old_classification'] }} → {{ $item['new_classification'] }}
                    </td>

                    <td class="text-right text-white">
                        @if($item['difference'] > 0)
                            +{{ $item['difference'] }}
                            <br>
                            ↑ Aumento no resultado
                        @elseif($item['difference'] < 0)
                            {{ $item['difference'] }}
                            <br>
                            ↓ Redução no resultado
                        @else
                            0
                            <br>
                            → Manteve
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-section-card>
