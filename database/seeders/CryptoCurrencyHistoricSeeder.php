<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CryptoCurrencyHistoricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apiKey = config('services.coinmarketcap.api_key');
        $endpoint = config('services.coinmarketcap.base_uri') . 'cryptocurrency/listings/latest';

        $response = Http::withHeaders([
            'X-CMC_PRO_API_KEY' => $apiKey,
            'Accepts' => 'application/json',
        ])->get($endpoint);

        if ($response->successful()) {
            $cryptocurrencies = $response->json('data');
            foreach ($cryptocurrencies as $crypto) {

                // Crearem una url per a fer una altra petició a l'API de CoinGecko
                $cgEndpoint = 'https://api.coingecko.com/api/v3/coins/' . $crypto['slug'] . '/market_chart?vs_currency=usd&days=1';
                $this->command->info('Fetching cryptocurrency: ' . $cgEndpoint);

                $cgResponse = Http::withHeaders([
                    'x_cg_demo_api_key' => env('CG_API_KEY'),
                    'Accepts' => 'application/json',
                ])->get($cgEndpoint);

                if ($cgResponse->successful()) {

                    $historial = $cgResponse->json('prices');

                    $historialData =  json_encode($historial);
                    $this->command->info('Fetching cryptocurrency: ' . $historialData);


                    DB::table('crypto_currency_historics')->insert([
                        'rank_id' => $crypto['cmc_rank'],
                        'name' => $crypto['name'],
                        'symbol' => $crypto['symbol'],
                        'slug' => $crypto['slug'],
                        'price' => $crypto['quote']['USD']['price'],
                        'percent_change_1h' => $crypto['quote']['USD']['percent_change_1h'],
                        'percent_change_24h' => $crypto['quote']['USD']['percent_change_24h'],
                        'percent_change_7d' => $crypto['quote']['USD']['percent_change_7d'],
                        'market_cap' => $crypto['quote']['USD']['market_cap'],
                        'volume_24h' => $crypto['quote']['USD']['volume_24h'],
                        'total_supply' => $crypto['total_supply'],
                        'historial' => $historialData,
                    ]);
                } else {
                    Log::error('Error fetching cryptocurrencies: ' . $cgResponse->body());
                }
            }
        } else {
            Log::error('Error fetching cryptocurrencies: ' . $response->body());
        }
    }
}
