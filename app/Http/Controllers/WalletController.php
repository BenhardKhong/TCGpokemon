<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\WalletTransaction;

class WalletController extends Controller
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
        // USER
        // =========================

        $user = User::find(
            session('user_id')
        );

        // =========================
        // HISTORY
        // =========================

        $transactions =
        WalletTransaction::where(
            'user_id',
            $user->id
        )
        ->latest()
        ->get();

        return view('wallet', compact(
            'user',
            'transactions'
        ));
    }

    public function topup(Request $request)
    {
        // =========================
        // USER
        // =========================

        $user = User::find(
            session('user_id')
        );

        // =========================
        // TAMBAH WALLET
        // =========================

        $user->wallet +=
        $request->amount;

        $user->save();

        // =========================
        // HISTORY
        // =========================

        WalletTransaction::create([

            'user_id' => $user->id,

            'type' => 'topup',

            'amount' => $request->amount

        ]);

        return back()->with(
            'success',
            'Top up berhasil'
        );
    }
}