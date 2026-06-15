<x-section-card>

    <h2 class="font-bold text-lg mb-4">
        Distribuição das Classificações
    </h2>

    <canvas id="classification-chart"></canvas>

</x-section-card>

<script>

document.addEventListener('DOMContentLoaded', () => {

    new Chart(
        document.getElementById('classification-chart'),
        {
            type: 'pie',

            data: {
                labels: @json(
                    $classifications->pluck('classification')
                ),

                datasets: [{
                    data: @json(
                        $classifications->pluck('total')
                    )
                }]
            }
        }
    );

});

</script>
