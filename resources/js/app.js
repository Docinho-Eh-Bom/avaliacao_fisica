import './bootstrap';
import {Chart} from 'chart.js/auto';
import ChartDataLabels from 'chartjs-plugin-datalabels';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

Chart.register(ChartDataLabels);
Chart.defaults.set('plugins.datalabels', {
    color: '#bceaf3'
});
