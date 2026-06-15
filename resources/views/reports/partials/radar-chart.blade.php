<x-section-card>

    <h2 class="text-lg font-bold mb-4 dark:text-white">
        Perfil Geral
    </h2>

    <canvas id="radarChart"></canvas>

</x-section-card>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const data = @json($chartData);
        const ctx = document.getElementById('radarChart');
        new Chart(ctx, {
            type: 'radar',
            data: {
                labels: data.map(i => i.label),
                datasets: [{
                    label: 'Desempenho',
                    data: data.map(i => i.score)
                }]
            }
        });
});
</script>
