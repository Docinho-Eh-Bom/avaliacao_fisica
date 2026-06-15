import './bootstrap';
import {Chart} from 'chart.js/auto';
import { BrowserRouter } from "react-router-dom";
import ChartDataLabels from 'chartjs-plugin-datalabels';
import Alpine from 'alpinejs';

<BrowserRouter basename="/apollon"></BrowserRouter>

window.Alpine = Alpine;

Alpine.start();

Chart.register(ChartDataLabels);
Chart.defaults.set('plugins.datalabels', {
    color: '#bceaf3'
});
