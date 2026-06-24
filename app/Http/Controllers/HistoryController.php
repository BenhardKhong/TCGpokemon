<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\GachaHistory;

class HistoryController extends Controller
{
    public function index()
    {
        // =========================
        // LOGIN
        // =========================

        if(!session()->has('user_id'))
        {
            return redirect('/login');
        }

        // =========================
        // HISTORY
        // =========================

        $histories = GachaHistory::with([
            'pokemonCard'
        ])
        ->where(
            'user_id',
            session('user_id')
        )
        ->latest()
        ->get();

        return view(
            'history',
            compact('histories')
        );
    }

    public function show($id)
    {
        // =========================
        // DETAIL
        // =========================

        $history = GachaHistory::with([
            'pokemonCard',
            'user'
        ])->find($id);

        // =========================
        // SECURITY
        // =========================

        if(
            $history->user_id
            != session('user_id')
        )
        {
            return redirect('/history');
        }
       
        $userCard = \App\Models\UserCard::find(
            $history->user_card_id
        );

        return view(
            'history-detail',
            compact(
             'history',
             'userCard'
            )
        );
    }
}