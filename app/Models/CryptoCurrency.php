<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoCurrency extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cryptocurrencies';

    protected $fillable = [
        'rank',
        'name',
        'symbol',
        'slug',
        'price',
        'volume_change_1h',
        'volume_change_24h',
        'volume_change_7d',
        'market_cap',
        'volume_24h',
        'total_supply',
    ];
}
