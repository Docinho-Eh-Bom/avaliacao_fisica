<x-section-card>
    <h3 class="text-lg font-bold mb-4 dark:text-white">{{ $testName }}</h3>

    <div class="h-[400px]">
        <canvas
            id="history-chart-{{ Str::slug($testName) }}"
        ></canvas>
    </div>

</x-section-card>
<script>

document.addEventListener('DOMContentLoaded', () => {
    const ctx =
        document.getElementById('history-chart-{{ Str::slug($testName) }}');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json(collect($data)->pluck('year')),

            datasets: [
                {
                    label: '{{ $testName }}',

                    data: @json(collect($data)->pluck('value')),

                    borderColor: '#2563eb',
                    backgroundColor: '#2563eb',
                    borderWidth: 4,
                    tension: 0.3,
                    pointRadius: 8,
                    pointHoverRadius: 10,

                    datalabels:{
                        display: true,
                        anchor: 'end',
                        align: 'top',
                        offset: 3
                    }
                }
            ]
        },

        plugins:[ChartDataLabels],

        options:{
            responsive:true,
            plugins:{
                legend:{
                    labels:{
                        color:'#FFFFFF'
                    }
                },

                datalabels:{
                    color:'#FFFFFF'
                }
            },

            scales:{
                x:{
                    ticks:{
                        color:'#FFFFFF'
                    },
                    grid:{
                        color:'rgba(255,255,255,0.1)'
                    }
                },

                y:{
                    beginAtZero:true,
                    ticks:{
                        color:'#FFFFFF'
                    },
                    grid:{
                        color:'rgba(255,255,255,0.1)'
                    }
                }
            }
        }
    });
});
</script>
