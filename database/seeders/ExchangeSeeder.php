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
        // Obtener la parte base de la URL de la API desde el archivo .env
        $baseUrl = env('API_BASE_URL');

        // Concatenar con el endpoint necesario
        $apiEndpoint = 'v1/exchange/info?id=270,271,272,273,274,275,276,277,278,279,280,281,282,283,284,285,286,287,288,289,290,291,292,293,294,295,296,297,298,299,300,301,302,303,304,305,306,307,308,310,311,313,314,315,316,317,318,319,320';
        $apiUrl = rtrim($baseUrl, '/') . '/' . ltrim($apiEndpoint, '/');
        $apiKey = env('API_KEY');
        $headers = [
            'X-CMC_PRO_API_KEY' => $apiKey,
            'Accepts' => 'application/json',
        ];


        // Hacer la solicitud a la API
        $response = Http::withHeaders($headers)->get($apiUrl);

        $this->command->info($response);

        // Verificar si la solicitud fue exitosa
        if ($response->successful()) {
            // Obtener los datos del JSON de la respuesta
            $data = $response->json()['data'];

            // Iterar sobre los datos y crear registros en la tabla exchanges
            foreach ($data as $exchangeData) {
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

            $this->command->info('ExchangeSeeder ejecutado exitosamente!');
        } else {
            $this->command->error('Error al obtener datos de la API');
        }
    }
}
