<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PokemonCard;
use App\Models\UserCard;
use App\Models\GachaHistory;
use App\Models\GlobalSetting;
use App\Models\User;

class GachaController extends Controller
{
    public function gacha($machine)
    {
        // =========================
        // LOAD GLOBAL SETTINGS (prices & epic chance)
        // =========================

        $setting = GlobalSetting::first();

        if(!$setting)
        {
            $setting = GlobalSetting::create([
                'epic_chance' => 1,
                'price_50' => 50000,
                'price_150' => 150000,
                'price_300' => 300000,
            ]);
        }

        $epicChance = $setting->epic_chance;

        // =========================
        // HARGA MESIN (from settings)
        // =========================

        if($machine == 50)
        {
            $price = $setting->price_50;
        }
        elseif($machine == 150)
        {
            $price = $setting->price_150;
        }
        else
        {
            $price = $setting->price_300;
        }

        // =========================
        // CEK LOGIN
        // =========================

        if(!session()->has('user_id'))
        {
            return back()->with('error', 'Harus login');
        }

        // =========================
        // AMBIL USER
        // =========================

        $user = User::find(session('user_id'));

        // =========================
        // CEK SALDO
        // =========================

        if($user->wallet < $price)
        {
            return back()->with('error', 'Saldo tidak cukup');
        }

        // =========================
        // KURANGI SALDO
        // =========================

        $user->wallet -= $price;

        $user->save();

        // =========================
        // BIG WIN CHANCE
        // =========================
        $setting = GlobalSetting::first();

        if(!$setting)
        {
            $setting = GlobalSetting::create([
                'epic_chance' => 1
            ]);
        }

        $epicChance = $setting->epic_chance;
        // =========================
        // RANDOM
        // =========================

        $random = rand(1,1000);

        // =========================
        // RARITY
        // =========================

        if($machine == 50){
            if($random <= 800)
            {
                $rarity = 'common';
            }
            elseif($random <= 950)
            {
                $rarity = 'uncommon';
            }
            elseif($random <= 990)
            {
                $rarity = 'rare';
            }
            else
            {
                $rarity = 'epic';
            }
        }

        elseif($machine == 150)
        {
            // Exclude 'common' for 150k machine: only uncommon, rare, epic
            if($random <= 650)
            {
                $rarity = 'uncommon';
            }
            elseif($random <= 950)
            {
                $rarity = 'rare';
            }
            else
            {
                $rarity = 'epic';
            }
        }

        else
        {
            // Exclude 'common' and 'uncommon' for highest machine: only rare and epic
            if($random <= 950)
            {
                $rarity = 'rare';
            }
            else
            {
                $rarity = 'epic';
            }
        }
        

        // =========================
        // APPLY EPIC PITY BONUS
        // If GlobalSetting->epic_chance is > 0, perform an additional
        // roll that can upgrade the result to `epic`.
        // epic_chance is stored as percent (e.g. 1 => 1%), convert to per-1000.
        // =========================

        $epicBoostThreshold = (int) max(0, round($epicChance * 10));

        if($epicBoostThreshold > 0)
        {
            $epicRoll = rand(1,1000);

            if($epicRoll <= $epicBoostThreshold)
            {
                $rarity = 'epic';
            }
        }

        // =========================
        // AMBIL KARTU
        // =========================

        $card = PokemonCard::where('rarity', $rarity)
                ->inRandomOrder()
                ->first();
        
        if(!$card){
            return response()->json([
                'error' => 'Card not found'
            ], 500);
        }

        // =========================
        // SIMPAN INVENTORY
        // =========================

        $userCard = UserCard::create([

            'user_id' => $user->id,

            'pokemon_card_id' => $card->id

        ]);

        // =========================
        // SIMPAN HISTORY
        // =========================

        GachaHistory::create([
            'user_id' => $user->id,
            'pokemon_card_id' => $card->id,
            'machine_price' => $price,
            'user_card_id' => $userCard->id
        ]);

        // =========================
        // PITY SYSTEM
        // =========================

        if($rarity == 'epic')
        {
            $setting->epic_chance = 1;
        }
        else
        {
            $setting->epic_chance += 0.2;
        }

        $setting->save();

        // =========================
        // HASIL
        // =========================

        return response()->json([

            'success' => true,

            'card_name' => $card->name,

            'card_image' => $card->image,

            'card_rarity' => $card->rarity,

            'card_price' => $card->market_price,

            'wallet' => $user->wallet,

            'epic_chance' => $setting->epic_chance

        ]);
            }
        public function machineCards($machine)
    {
        // =========================
        // FILTER BERDASARKAN MESIN
        // =========================

        if($machine == 50)
        {
            $cards = PokemonCard::whereIn('rarity', [
                'common',
                'uncommon',
                'rare',
                'epic'
            ])->get();
        }

        elseif($machine == 150)
        {
            $cards = PokemonCard::whereIn('rarity', [
                'uncommon',
                'rare',
                'epic'
            ])->get();
        }

        else
        {
            $cards = PokemonCard::whereIn('rarity', [
                'rare',
                'epic'
            ])->get();
        }

        // Ensure unique cards by name in case seeders ran multiple times
        $unique = $cards->unique('name')->values();

        return response()->json($unique);
    }
}