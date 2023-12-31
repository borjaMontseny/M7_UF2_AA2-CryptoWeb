<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoCurrencyHistoric extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'crypto_currency_historics';

    protected $fillable = [
        'rank_id',
        'name',
        'symbol',
        'slug',
        'price',
        'percent_change_1h',
        'percent_change_24h',
        'percent_change_7d',
        'market_cap',
        'volume_24h',
        'total_supply',
        'historial'
    ];

    public function cryptoCurrency()
{
    return $this->belongsTo(CryptoCurrency::class, 'slug', 'slug');
}
}
