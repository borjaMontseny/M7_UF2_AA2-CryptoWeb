<x-app-layout>
    @auth
    <div class="py-12">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="bg-gray-200 bg-opacity-25 p-6 lg:p-8">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Preu</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">1h %</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">24h %</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">7d %</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cap. de mercat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Volum (24h)</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Accions en circulació</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($cryptoCurrencies as $cripto)
                                <tr class="">
                                    <td class="px-6 py-4 whitespace-nowrap transition-all hover:bg-gray-100 text-right">{{ $cripto->rank_id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap transition-all hover:bg-gray-100">{{ $cripto->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap transition-all hover:bg-gray-100 text-right">{{ "$".round($cripto->price, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap transition-all hover:bg-gray-100 text-right">{{ round($cripto->percent_change_1h, 2)."%" }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap transition-all hover:bg-gray-100 text-right">{{ round($cripto->percent_change_24h, 2)."%" }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap transition-all hover:bg-gray-100 text-right">{{ round($cripto->percent_change_7d, 2)."%" }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap transition-all hover:bg-gray-100 text-right">{{ "$".$cripto->market_cap }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap transition-all hover:bg-gray-100 text-right">{{ "$".$cripto->volume_24h }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap transition-all hover:bg-gray-100 text-right">{{ "$".$cripto->total_supply }}</td>
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

                    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
                        <div>
                            <p>Para poder ver las monedas necesistas iniciar sessión.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endauth
</x-app-layout>
