<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\PokemonCard;

class PokemonCardSeeder extends Seeder
{
    public function run(): void
    {
        PokemonCard::create([
            'name' => 'Pikachu',
            'rarity' => 'common',
            'market_price' => 50000,
            'image' => 'https://images.pokemontcg.io/base1/58_hires.png'
        ]);

        PokemonCard::create([
            'name' => 'Bulbasaur',
            'rarity' => 'common',
            'market_price' => 45000,
            'image' => 'https://images.pokemontcg.io/base1/44_hires.png'
        ]);

        PokemonCard::create([
            'name' => 'Squirtle',
            'rarity' => 'common',
            'market_price' => 60000,
            'image' => 'https://images.pokemontcg.io/base1/63_hires.png'
        ]);

        PokemonCard::create([
            'name' => 'Charmander',
            'rarity' => 'uncommon',
            'market_price' => 90000,
            'image' => 'https://images.pokemontcg.io/base1/46_hires.png'
        ]);

        PokemonCard::create([
            'name' => 'Blastoise',
            'rarity' => 'rare',
            'market_price' => 200000,
            'image' => 'https://images.pokemontcg.io/base1/2_hires.png'
        ]);

        PokemonCard::create([
            'name' => 'Charizard',
            'rarity' => 'epic',
            'market_price' => 450000,
            'image' => 'https://images.pokemontcg.io/base1/4_hires.png'
        ]);
    }
}