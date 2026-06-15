<x-section-card>
    <h2 class="font-bold text-lg mb-4 text-white">Alunos por Turma</h2>

    @php
    $maxValue = $classDistribution->pluck('students_count')->max() ?? 1;
    @endphp

    <div class="h-[258px] w-[575px]">
        <canvas id="class-chart"></canvas>
    </div>
</x-section-card>

<script>
document.addEventListener('DOMContentLoaded', () => {
    new Chart(
        document.getElementById('class-chart'),{
            type: 'bar',
            data: {
                labels: @json($classDistribution->pluck('name')),
                datasets: [{
                    label: 'Alunos',
                    data: @json($classDistribution->pluck('students_count')),

                    datalabels:{
                        display: true,
                        anchor: 'end',
                        align: 'top',
                        offset: 2
                    }
                }]
            },
            plugins: [ChartDataLabels],
            options: {
                responsive: true,
                // maintainAspectRatio: false,
                plugins:{
                    legend:{
                        display: false,
                        labels:{
                            color: '#FFFFFF',
                        }
                    },
                    datalabels:{
                        color: '#FFFFFF'
                    }
                },
                scales: {
                    x: {
                        beginsAtZero: true,
                        grid: {
                            display: false,
                            color: 'rgba(226, 226, 226, 0.1)'
                        },
                        ticks:{
                            color: '#FFFFFF'
                        }
                    },
                    y: {
                        beginsAtZero: true,
                        max: {{ ceil(($maxValue + 5) / 10) * 10 }},
                        grid: {
                            display: false,
                            color: 'rgba(226, 226, 226, 0.1)'
                        },
                        ticks: {
                            stepSize: 1,
                            color: '#FFFFFF'
                        }
                    }
                }
            }
        },
    );
});
</script>
