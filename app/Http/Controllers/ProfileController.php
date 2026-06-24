<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\UserCard;
use App\Models\GachaHistory;

class ProfileController extends Controller
{
    public function index(){

        // =========================
        // CEK LOGIN
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
        // TOTAL CARD
        // =========================

        $totalCards = UserCard::where(
            'user_id',
            $user->id
        )->count();

        // =========================
        // TOTAL GACHA
        // =========================

        $totalGacha = GachaHistory::where(
            'user_id',
            $user->id
        )->count();

        return view('profile', compact(

            'user',

            'totalCards',

            'totalGacha'

        ));
    }


    public function update(Request $request){
        
        // =========================
        // USER
        // =========================

        $user = User::find(
            session('user_id')
        );

        // =========================
        // UPDATE DATA
        // =========================

        $user->username =
        $request->username;

        $user->email =
        $request->email;

        // =========================
        // PASSWORD
        // =========================

        if($request->password)
        {
            $user->password =
            bcrypt($request->password);
        }

        // =========================
        // PHOTO
        // =========================

        if($request->hasFile('profile_photo'))
        {
            $file = $request->file(
                'profile_photo'
            );

            $filename =
            time().'_'.$file->getClientOriginalName();

            $file->move(
                public_path('profiles'),
                $filename
            );

            $user->profile_photo =
            $filename;
        }

        $user->save();

        return back()->with(
            'success',
            'Profile berhasil diupdate'
        );
    }



}