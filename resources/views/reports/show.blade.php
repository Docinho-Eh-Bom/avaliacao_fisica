<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <x-page-title>Relatório de Avaliação Física</x-page-title>

            <div class="flex gap-2">
                <form id="pdf-form" action="{{ route('reports.pdf', $battery) }}" method="POST">
                    @csrf
                    <input type="hidden" name="charts" id="charts-input">
                </form>

                <x-primary-button type="button" onclick="exportPdf()">Exportar PDF</x-primary-button>

                <a href="{{ route('batteries.show', $battery) }}">
                    <x-secondary-button>Voltar</x-secondary-button>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6 flex flex-wrap">
        <div class="max-w-7xl mx-auto space-y-6">
            <x-section-card>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nome</p>
                        <p class="mt-1 text-lg font-semibold dark:text-gray-100">{{ $battery->student->name }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Idade</p>
                        <p class="mt-1 text-lg font-semibold dark:text-gray-100">{{ $battery->student->age }} anos</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Sexo</p>
                        <p class="mt-1 text-lg font-semibold dark:text-gray-100">{{  $battery->student->gender == 'M' ? 'Masculino' : 'Feminino' }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Turma</p>
                        <p class="mt-1 text-lg font-semibold dark:text-gray-100">{{ $battery->student->classGroup?->name ?? 'Sem turma' }}</p>
                    </div>
                </div>
            </x-section-card>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <x-section-card>
                    <h2 class="text-lg font-bold mb-4 dark:text-white">Composição Corporal</h2>

                    @include('reports.partials.result-card',['results' => $body])
                    @include('reports.partials.result-card',['results' => $derived])
                </x-section-card>

                <x-section-card>
                    <h2 class="text-lg font-bold mb-4 dark:text-white">Aptidão Física</h2>

                    @include('reports.partials.result-card',['results' => $health])
                </x-section-card>

                <x-section-card>
                    <h2 class="text-lg font-bold mb-4 dark:text-white">Desempenho Motor</h2>

                    @include('reports.partials.result-card',['results' => $motor])
                </x-section-card>
            </div>

            <x-section-card>
                <h2 class="text-lg font-bold mb-4 dark:text-white">Gráficos</h2>
                <!-- @include('reports.partials.radar-chart') -->
                <div class="space-y-10">
                @foreach($health as $result)
                    @if($result->final_value !== null)
                        @include('reports.partials.line-chart', [
                            'result' => $result
                        ])
                    @endif
                @endforeach

                @foreach($motor as $result)
                    @if($result->final_value !== null)
                        @include('reports.partials.line-chart', ['result' => $result])
                    @endif
                @endforeach
            </x-section-card>
        </div>
    </div>
</x-app-layout>

<script>
    async function exportPdf(){
        const charts = [];
        for(const canvas of document.querySelectorAll('canvas')){

        const chart = Chart.getChart(canvas);
        const title = canvas.getAttribute('data-title');

        chart.options.plugins.legend.labels.color = '#000';
        chart.options.plugins.datalabels.color = '#000';
        chart.options.scales.x.ticks.color = '#000';
        chart.options.scales.y.ticks.color = '#000';
        chart.update();

        await new Promise(resolve => requestAnimationFrame(resolve));

        charts.push({
            title: canvas.dataset.title,
            image: canvas.toDataURL('image/png')
        });

        chart.options.plugins.legend.labels.color = '#FFFFFF';
        chart.options.plugins.datalabels.color = '#FFFFFF';
        chart.options.scales.x.ticks.color = '#FFFFFF';
        chart.options.scales.y.ticks.color = '#FFFFFF';
        chart.update();
    }

    document.getElementById('charts-input').value = JSON.stringify(charts);

        window.dispatchEvent(
            new CustomEvent('notify', {
                detail: {
                    type: 'success',
                    message: 'PDF exportado com sucesso!'
                }
            })
        );

        document.getElementById('pdf-form').submit();
    }
</script>


