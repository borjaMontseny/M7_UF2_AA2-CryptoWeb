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
        'rank_id',
        'name',
        'symbol',
        'slug',
        'price',
<<<<<<< .merge_file_Uj2hle
        'volume_change_1h',
        'volume_change_24h',
        'volume_change_7d',
=======
        'percent_change_1h',
        'percent_change_24h',
        'percent_change_7d',
>>>>>>> .merge_file_s1NfBo
        'market_cap',
        'volume_24h',
        'total_supply',
    ];
<<<<<<< .merge_file_Uj2hle
}
=======
}
>>>>>>> .merge_file_s1NfBo
