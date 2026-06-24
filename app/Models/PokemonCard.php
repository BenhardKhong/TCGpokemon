<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PokemonCard extends Model
{
    protected $fillable = [
        'name',
        'rarity',
        'market_price',
        'image'
    ];
}