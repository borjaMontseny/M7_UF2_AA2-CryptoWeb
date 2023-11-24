<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DataBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this -> call(CryptoCurrencySeeder::class);
        $this -> call(ExchangeSeeder::class);
        $this -> call(CryptoCurrencyHistoricSeeder::class);
    }
}