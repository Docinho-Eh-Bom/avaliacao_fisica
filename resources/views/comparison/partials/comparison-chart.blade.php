<x-section-card>
    <h2 class="font-bold text-lg mb-4 text-white">Comparação dos Resultados</h2>

    <div style="height: 500px;">
        <canvas id="comparison-chart"></canvas>
    </div>
</x-section-card>

<script>
document.addEventListener('DOMContentLoaded', () => {
        new Chart(
            document.getElementById('comparison-chart'),
            {
                type: 'bar',
                data: {
                    labels: @json($comparison->pluck('test')),
                    color: '#FFFFFF',
                    datasets: [{
                            label: '{{ $battery1->year }}',
                            data: @json($comparison->pluck('old_value')),
                            color: '#FFFFFF',
                            datalabels:{
                                display: true,
                                anchor: 'end',
                                align: 'top',
                                offset: '1'
                            }
                        },
                        {
                            label: '{{ $battery2->year }}',
                            data: @json($comparison->pluck('new_value')),
                            color: '#FFFFFF',
                            datalabels:{
                                display: true,
                                anchor: 'end',
                                align: 'top',
                                offset: '1'
                            }
                        },
                    ]
                },
                plugins: [ChartDataLabels],
                options:{
                    responsive:true,
                    maintainAspectRatio:false,
                    plugins:{
                        legend:{
                            display: true,
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
                        grid: {
                            display: false,
                            color: 'rgba(226, 226, 226, 0.1)'
                        },
                        ticks:{
                            color: '#FFFFFF'
                        }
                    },
                    y: {
                        ticks: {
                            color: '#FFFFFF'
                        }
                    }
                }
                }
            }
        );
    }
);

</script>
