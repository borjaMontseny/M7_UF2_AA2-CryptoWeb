<x-app-layout>
    @auth

        <head>
            <script src="https://code.highcharts.com/highcharts.js"></script>
            <script src="https://code.highcharts.com/modules/exporting.js"></script>
            <script src="https://code.highcharts.com/modules/export-data.js"></script>
            <script src="https://code.highcharts.com/modules/accessibility.js"></script>
        </head>

        <div class="py-12">
            <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                    <div class="bg-gray-200 bg-opacity-25 p-6 lg:p-8">
                        <h1><strong>{{ $cryptoCurrency->name }}</strong></h1>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Símbol</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Preu</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Canvi percentual en 1h</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Canvi percentual en 24h</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Canvi percentual en 7d</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Capitalització de mercat</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Volum en 24h</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Accions en circulació</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $cryptoCurrency->symbol }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">${{ number_format($cryptoCurrency->price, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ number_format($cryptoCurrency->percent_change_1h, 2) }}%</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ number_format($cryptoCurrency->percent_change_24h, 2) }}%</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ number_format($cryptoCurrency->percent_change_7d, 2) }}%</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        ${{ number_format($cryptoCurrency->market_cap, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        ${{ number_format($cryptoCurrency->volume_24h, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        ${{ number_format($cryptoCurrency->total_supply, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <br>

                        <h2><strong>Historial</strong></h2>
                        <div id="cryptoChart" style="height: 300px;"></div>
                    </div>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Obtener datos del historial y formatearlos
                    var historialArray = @json($historialArray);
                    var categories = historialArray.map(item => new Date(item[0]).toLocaleString());
                    var values = historialArray.map(item => parseFloat(item[1]).toFixed(2));

                    // Convertir valores a números
                    values = values.map(parseFloat);

                    Highcharts.chart("cryptoChart", {
                        chart: {
                            type: "line",
                        },
                        title: {
                            text: "",
                        },
                        xAxis: {
                            categories: categories,
                            lineColor: "transparent",
                            labels: {
                                enabled: false,
                            },
                            title: {
                                text: "",
                            },
                            gridLineWidth: 0,
                        },
                        yAxis: {
                            labels: {
                                enabled: false,
                            },
                            title: {
                                text: "",
                            },
                            gridLineWidth: 0,
                        },
                        legend: {
                            enabled: false,
                        },
                        plotOptions: {
                            series: {
                                marker: {
                                    enabled: false, // Oculta los marcadores de la línea
                                },
                            },
                        },
                        series: [{
                            name: "Precio de la Criptomoneda",
                            data: values,
                            color: "blue",
                        }],
                        tooltip: {
                            pointFormat: '<span style="color:{point.color}">\u25CF</span> {series.name}: <b>${point.y:,.2f}</b><br/>'
                        },
                        credits: {
                            enabled: false,
                        },
                        chart: {
                            events: {
                                load: function() {
                                    // Oculta completamente el eje X y sus clases asociadas
                                    this.xAxis[0].axisGroup.hide();
                                },
                            },
                        },
                    });
                });
            </script>

            <h2><strong>Historial</strong></h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Data i hora</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Preu</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($historialArray as $historial)
                        <tr>
                            <td class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ date('d-m-Y H:i:s', $historial[0] / 1000) }}</td>
                            <td
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider {{ number_format($historial[1], 2) > number_format($cryptoCurrency->price, 2) ? 'text-green-500' : 'text-red-500' }}">
                                ${{ number_format($historial[1], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        </div>
        </div>
        </div>
    @else
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                        <div class="mt-8 text-2xl">
                            Benvingut!
                        </div>

                        <div class="mt-6 text-gray-500">
                            Siusplau, inicia sessió per veure els detalls de la criptomoneda.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endauth
</x-app-layout>
