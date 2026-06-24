<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GlobalSetting;

class AdminController extends Controller
{
    public function index()
    {
        if(!session('is_admin')) return redirect('/');

        $setting = GlobalSetting::first();

        return view('admin.settings', compact('setting'));
    }

    public function update(Request $request)
    {
        if(!session('is_admin')) return redirect('/');

        $request->validate([
            'epic_chance' => 'required|numeric',
            'price_50' => 'required|numeric',
            'price_150' => 'required|numeric',
            'price_300' => 'required|numeric'
        ]);

        $setting = GlobalSetting::first();

        if(!$setting){
            $setting = GlobalSetting::create($request->only(['epic_chance','price_50','price_150','price_300']));
        } else {
            $setting->update($request->only(['epic_chance','price_50','price_150','price_300']));
        }

        return redirect('/admin/settings')->with('success','Settings updated');
    }
}
