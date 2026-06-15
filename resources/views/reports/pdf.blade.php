<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <style>
        body{
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #222;
        }

        h1{
            text-align: center;
            margin-bottom: 20px;
        }

        h2{
            margin-top: 25px;
            margin-bottom: 10px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th, td{
            border: 1px solid #ddd;
            padding: 6px;
        }

        th{
            background: #f3f4f6;
        }

        .student-info{
            margin-bottom: 20px;
        }

        .student-info p{
            margin: 3px 0;
        }

        .result-card{
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 15px;
        }

        .classification{
            font-weight: bold;
        }

        .ref-table{
            width: 100%;
            margin-top: 10px;
            text-align: center;
        }

        .ref-table td{
            padding: 8px;
        }

        .chart{
            margin-top: 10px;
            text-align: center;
        }

        .chart img{
            max-width: 100%;
            height: auto;
        }

        .page-break{
            page-break-after: always;
        }
    </style>
</head>
<body>
    <h1>Relatório de Avaliação Física</h1>

    <div class="student-info">
        <p><strong>Aluno:</strong> {{ $battery->student->name }}</p>
        <p><strong>Idade:</strong> {{ $battery->student->age }} anos</p>
        <p>
            <strong>Sexo:</strong>
            {{ $battery->student->gender == 'M' ? 'Masculino' : 'Feminino' }}
        </p>
        <p>
            <strong>Turma:</strong>
            {{ $battery->student->classGroup?->name ?? 'Sem turma' }}
        </p>
        <p><strong>Ano:</strong> {{ $battery->year }}</p>
    </div>

    <h2>Composição Corporal</h2>
    @foreach($body as $result)
        <div class="result-card">
            <strong>{{ $result->testType->name }}</strong><br>
            Resultado:
            {{ $result->final_value ?? '-' }}
            {{ $result->testType->unit ?? '' }}
            <br>
            Classificação:
            {{ $result->classification_label ?? 'Sem resultado' }}
        </div>
    @endforeach

    @foreach($derived as $result)
        <div class="result-card">
            <strong>{{ $result->name }}</strong><br>
            Resultado:
            {{ $result->final_value ?? '-' }}
            {{ $result->unit ?? '' }}
            <br>
            Classificação:
            {{ $result->classification_label ?? 'Sem resultado' }}
        </div>
    @endforeach

    <h2>Aptidão Física</h2>
    @foreach($health as $result)
        <div class="result-card">
            <strong>{{ $result->testType->name }}</strong><br>

            Resultado:
            {{ $result->final_value }}
            {{ $result->testType->unit }}
            <br>
            Classificação:
            <span class="classification">
                {{ $result->classification_label }}
            </span>

            @if(isset($result->referenceValues)
                && $result->referenceValues->count())
                <table class="ref-table">
                    <tr>
                        <th>Fraco</th>
                        <th>Razoável</th>
                        <th>Bom</th>
                        <th>Muito Bom</th>
                        <th>Excelente</th>
                    </tr>

                    <tr>
                        @foreach($result->referenceValues as $ref)
                            <td>
                                @if($ref->label === 'weak')
                                    < {{ $ref->max_value }}
                                @elseif($ref->label === 'excellent')
                                    ≥ {{ $ref->min_value }}
                                @else
                                    {{ $ref->min_value }}
                                    -
                                    {{ $ref->max_value }}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                </table>
            @endif
        </div>

    @endforeach

    <h2>Desempenho Motor</h2>

    @foreach($motor as $result)
        <div class="result-card">
            <strong>{{ $result->testType->name }}</strong><br>

            Resultado:
            {{ $result->final_value }}
            {{ $result->testType->unit }}
            <br>
            Classificação:
            <span class="classification">
                {{ $result->classification_label }}
            </span>

            @if(isset($result->referenceValues)
                && $result->referenceValues->count())
                <table class="ref-table">
                    <tr>
                        <th>Fraco</th>
                        <th>Razoável</th>
                        <th>Bom</th>
                        <th>Muito Bom</th>
                        <th>Excelente</th>
                    </tr>

                    <tr>
                        @foreach($result->referenceValues as $ref)
                            <td>
                                @if($ref->label === 'weak')
                                    < {{ $ref->max_value }}
                                @elseif($ref->label === 'excellent')
                                    ≥ {{ $ref->min_value }}
                                @else
                                    {{ $ref->min_value }}
                                    -
                                    {{ $ref->max_value }}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                </table>
            @endif
        </div>

    @endforeach

    @if(!empty($charts))
        <div class="page-break"></div>

        <h2>Gráficos</h2>

        @foreach($charts as $chart)
            <div class="chart">
                <h3 class="text-lg font-bold mb-4 dark:text-white">
                {{ $chart['title'] }}
                </h3>
                <img src="{{ $chart['image'] }}" alt="{{ $chart['title'] }}">
            </div>
            <br><br>
        @endforeach
    @endif

</body>
</html>

