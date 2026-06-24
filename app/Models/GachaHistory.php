<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GachaHistory extends Model
{
   protected $fillable = [

    'user_id',

    'pokemon_card_id',

    'machine_price',

    'user_card_id'

];

    // =========================
    // RELATION USER
    // =========================

    public function user()
    {
        return $this->belongsTo(
            User::class
        );
    }

    // =========================
    // RELATION CARD
    // =========================

    public function pokemonCard()
    {
        return $this->belongsTo(
            PokemonCard::class
        );
    }
}