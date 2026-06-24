<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserLocation;

class LocationController extends Controller
{
    public function index()
    {
        $locations =
        UserLocation::where(
            'user_id',
            session('user_id')
        )->get();

        return view(
            'locations',
            compact('locations')
        );
    }

    public function store(Request $request)
    {
        UserLocation::create([

            'user_id' =>
            session('user_id'),

            'location_name' =>
            $request->location_name,

            'receiver_name' =>
            $request->receiver_name,

            'phone' =>
            $request->phone,

            'address' =>
            $request->address,

            'city' =>
            $request->city,

            'province' =>
            $request->province,

            'postal_code' =>
            $request->postal_code

        ]);

        return back();
    }

    public function setDefault($id)
    {
        UserLocation::where(
            'user_id',
            session('user_id')
        )->update([
            'is_default' => false
        ]);

        UserLocation::find($id)
        ->update([
            'is_default' => true
        ]);

        return back();
    }
}