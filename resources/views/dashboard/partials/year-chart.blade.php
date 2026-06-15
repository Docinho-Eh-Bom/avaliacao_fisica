<x-section-card>
    <h2 class="font-bold text-lg mb-4 text-white">Avaliações por Ano</h2>

    <div class="h-[258px] w-[575px]">
        <canvas id="year-chart"></canvas>
    </div>
</x-section-card>

<script>
document.addEventListener('DOMContentLoaded', () => {
    new Chart(
        document.getElementById('year-chart'),
        {
            type: 'line',
            data: {
                labels: @json($batteriesPerYear->pluck('year')),
                datasets: [{
                    label: 'Avaliações',
                    data: @json($batteriesPerYear->pluck('total')),

                    datalabels: {
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
                        max: 50,
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
        }
    );
});
</script>
