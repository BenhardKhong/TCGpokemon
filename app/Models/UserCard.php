<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCard extends Model
{
    protected $fillable = [
        'user_id',
        'pokemon_card_id'
    ];

    public function pokemonCard()
    {
        return $this->belongsTo(
            PokemonCard::class
        );
    }
}