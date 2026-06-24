<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserCard;

class AlbumController extends Controller
{
    public function index()
    {
        // =========================
        // CEK LOGIN
        // =========================

        if(!session()->has('user_id'))
        {
            return redirect('/login');
        }

        // =========================
        // AMBIL KARTU USER
        // =========================

        $cards = UserCard::where(
            'user_id',
            session('user_id')
        )
        ->with('pokemonCard')
        ->latest()
        ->get();

        return view('album', compact('cards'));
    }

    public function sell($id){
        
        // =========================
        // CEK LOGIN
        // =========================

        if(!session()->has('user_id'))
        {
            return response()->json([
                'error' => 'Harus login'
            ], 401);
        }

        // =========================
        // AMBIL USER CARD
        // =========================

        $userCard = UserCard::with('pokemonCard')
                    ->find($id);

        if(!$userCard)
        {
            return response()->json([
                'error' => 'Card not found'
            ], 404);
        }

        // =========================
        // CEK PEMILIK
        // =========================

        if($userCard->user_id != session('user_id'))
        {
            return response()->json([
                'error' => 'Akses ditolak'
            ], 403);
        }

        // =========================
        // AMBIL USER
        // =========================

        $user = \App\Models\User::find(
            session('user_id')
        );

        // =========================
        // HARGA SELL
        // =========================

        $sellPrice =
        $userCard->pokemonCard->market_price;

        // =========================
        // TAMBAH WALLET
        // =========================

        $user->wallet += $sellPrice;

        $user->save();

        // =========================
        // HAPUS CARD
        // =========================

        $userCard->delete();

        // =========================
        // RETURN
        // =========================

        return response()->json([

            'success' => true,

            'wallet' => $user->wallet

        ]);
    }
}