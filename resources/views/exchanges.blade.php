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
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Spot      (USD)</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fiats</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Visitas Semanales</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Última Actualización</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($exchanges as $exchange)
                                    <tr class="">
                                        <td class="px-6 py-4 whitespace-nowrap transition-all hover:bg-gray-100 text-right">{{ $exchange->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap transition-all hover:bg-gray-100" style="display: flex;"><img src="{{ $exchange->logo }}" class="w-8 h-8">&nbsp;<a href="{{ route('history', ['cryptocurrency' => $exchange->slug]) }}">{{ $exchange->name }}</a></td>
                                        <td class="px-6 py-4 whitespace-nowrap transition-all hover:bg-gray-100 text-right">${{ number_format($exchange->spot_volume_usd, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap transition-all hover:bg-gray-100">
                                            @php
                                                $fiats = json_decode($exchange->fiats);
                                            @endphp
                                            @foreach ($fiats as $index => $fiat)
                                                {{ trim($fiat, ' " ') }}
                                                @if (!$loop->last)
                                                    ,
                                                @endif
                                                @if ($index % 3 === 2 && $index !== count($fiats) - 1)
                                                    <br>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap transition-all hover:bg-gray-100 text-right">{{ $exchange->weekly_visits }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap transition-all hover:bg-gray-100">{{ $exchange->updated_at->diffForHumans() }}</td>
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
                            <p>Para poder ver los intercambios necesitas iniciar sesión.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endauth
</x-app-layout>
