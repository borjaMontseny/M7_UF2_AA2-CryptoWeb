<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CryptoCurrencySeeder extends Seeder
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
                DB::table('cryptocurrencies')->insert([
                    'rank_id' => $crypto['cmc_rank'],
                    'name' => $crypto['name'],
                    'symbol' => $crypto['symbol'],
                    'slug' => $crypto['slug'],
                    'price' => $crypto['quote']['USD']['price'],
                    'volume_change_1h' => $crypto['quote']['USD']['percent_change_1h'],
                    'volume_change_24h' => $crypto['quote']['USD']['percent_change_24h'],
                    'volume_change_7d' => $crypto['quote']['USD']['percent_change_7d'],
                    'market_cap' => $crypto['quote']['USD']['market_cap'],
                    'volume_24h' => $crypto['quote']['USD']['volume_24h'],
                    'total_supply' => $crypto['total_supply'],
                ]);
            }
        } else {
            Log::error('Error fetching cryptocurrencies: ' . $response->body());
        }
    }
}