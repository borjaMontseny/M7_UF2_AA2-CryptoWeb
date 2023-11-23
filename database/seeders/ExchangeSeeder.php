<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Exchange;

class ExchangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Concatenar con el endpoint necesario
        $apiKey = config('services.coinmarketcap.api_key');
        $endpoint = config('services.coinmarketcap.base_uri') . 'exchange/info?id=270,10,11,12,13,14,15,16,17,18,19,20,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80';

        $response = Http::withHeaders([
            'X-CMC_PRO_API_KEY' => $apiKey,
            'Accepts' => 'application/json',
        ])->get($endpoint);

        // Verificar si la solicitud fue exitosa
        if ($response->successful()) {
            // Obtener los datos del JSON de la respuesta
            $data = $response->json()['data'];

            // Iterar sobre los datos y crear registros en la tabla exchanges
            foreach ($data as $exchangeData) {
                if ($exchangeData['spot_volume_usd'] != null) {
                    Exchange::create([
                        'id' => $exchangeData['id'],
                        'name' => $exchangeData['name'],
                        'slug' => $exchangeData['slug'],
                        'logo' => $exchangeData['logo'],
                        'fiats' => json_encode($exchangeData['fiats']),
                        'spot_volume_usd' => $exchangeData['spot_volume_usd'],
                        'weekly_visits' => $exchangeData['weekly_visits'],
                        // Añadir otras columnas según sea necesario
                    ]);
                }
            }

            $this->command->info('ExchangeSeeder ejecutado exitosamente!');
        } else {
            $this->command->error('Error al obtener datos de la API');
        }
    }
}
