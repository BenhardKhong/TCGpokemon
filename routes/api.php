<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GachaController;
use App\Models\GachaHistory;

Route::get('/machine/{machine}',
[GachaController::class, 'machineCards']);


Route::get('/history', function () {

    $histories = GachaHistory::with([
        'user',
        'pokemonCard'
    ])
    ->latest()
    ->take(15)
    ->get();

    return response()->json(
        $histories
    );
});