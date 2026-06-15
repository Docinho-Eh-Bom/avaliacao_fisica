    <h2 class="text-xl font-bold mb-4">Resultados</h2>
    <table class="w-full">
        <thead>
            <tr>
                <th class="text-left">Teste</th>
                <th class="text-center">Resultado</th>
                <th class="text-right">Classificação</th>
            </tr>
        </thead>

        <tbody>
            @foreach($battery->results as $result)
                <tr>
                    <td class="text-left">
                        {{ $result->testType->name }}
                    </td>

                    <td class="text-center">
                        {{ $result->final_value }}
                        {{ $result->testType->unit }}
                    </td>

                    <td class="text-right">
                        {{  $result->classification_label }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
