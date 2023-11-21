<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'exchanges';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'slug',
        'logo',
        'fiats',
        'spot_volume_usd',
        'weekly_visits',
    ];

    // Si deseas agregar relaciones, mutadores, accesores o cualquier otra funcionalidad 
    // específica del modelo, puedes hacerlo aquí.

    // Por ejemplo, si luego decides tener modelos separados para "Platform" y "Currency", 
    // podrías añadir métodos de relación como belongsTo() aquí.
}