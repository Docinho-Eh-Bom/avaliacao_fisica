<x-section-card>
    <h3 class="text-lg font-bold mb-4 dark:text-white">
        {{ $result->testType->name }}
    </h3>

    <div class="h-[500px]">
        <canvas id="chart-{{ $result->id }}" data-title="{{  $result->testType->name }}"></canvas>
    </div>
</x-section-card>

@php
    $refs = $result->referenceValues;

    $cutoffs = [
        $refs[0]->max_value ?? 0,
        $refs[1]->max_value ?? 0,
        $refs[2]->max_value ?? 0,
        $refs[3]->max_value ?? 0,
        $refs[4]->min_value ?? 0,
    ];

    $studentPoint = match($result->classification){
        'weak' => 0,
        'average' => 1,
        'good' => 2,
        'very_good' => 3,
        'excellent' => 4,
        default => 2,
    };

    $studentData = [null, null, null, null, null];
    $studentData[$studentPoint] = $result->final_value;
@endphp

<script>
document.addEventListener('DOMContentLoaded', () => {

    const ctx = document.getElementById(
        'chart-{{ $result->id }}'
    );

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: [
                'Fraco',
                'Razoável',
                'Bom',
                'Muito Bom',
                'Excelente'
            ],

            datasets: [
                {
                    label: 'Pontos de corte',
                    data: @json($cutoffs),
                    borderColor: '#94a3b8',
                    backgroundColor: '#94a3b8',
                    borderWidth: 4,
                    tension: 0.3,
                    pointRadius: 4,

                    datalabels: {
                        display: true,
                        anchor: 'end',
                        align: 'bottom',
                        offset: 7
                    }
                },
                {
                    label: 'Aluno',
                    data: @json($studentData),
                    borderColor: '#2563eb',
                    backgroundColor: '#2563eb',
                    showLine: false,
                    pointRadius: 8,
                    pointHoverRadius: 10,

                    datalabels:{
                        display: true,
                        anchor: 'end',
                        align: 'top',
                        offset: 2
                    }
                }
            ]
        },
        plugins: [ChartDataLabels],
        options: {
            responsive: true,
            //maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    labels:{
                        color: '#FFFFFF'
                    }
                },
                datalabels: {
                    color: '#FFFFFF',
                }
            },
            scales: {
                x:{
                    grid:{
                        color: 'rgba(226, 226, 226, 0.1)'
                    },
                    ticks:{
                        color: '#FFFFFF'
                    }
                },
                y: {
                    beginAtZero: true,
                    grid:{
                        color: 'rgba(226, 226, 226, 0.1)'
                    },
                    ticks:{
                        color: '#FFFFFF'
                    }
                }
            }
        }
    });
});
</script>
