<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GachaController;
use App\Http\Controllers\AlbumController;
use App\Models\GachaHistory;
use App\Models\GlobalSetting;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\CartController;

Route::get('/', function () {

    $histories = GachaHistory::with([
        'user',
        'pokemonCard'
    ])
    ->latest()
    ->take(15)
    ->get();

    // =========================
    // BIG WIN
    // =========================

    $setting = GlobalSetting::first();

    if(!$setting)
    {
        $setting = GlobalSetting::create([
            'epic_chance' => 1
        ]);
    }

    return view('home', [

        'histories' => $histories,

        'epicChance' =>
        $setting->epic_chance

    ]);
});
Route::get('/login', [AuthController::class, 'loginForm']);

Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'registerForm']);

Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout']);

Route::post('/gacha/{machine}',
[GachaController::class, 'gacha']);

Route::get('/album',
[AlbumController::class, 'index']);

Route::post('/sell/{id}',
[AlbumController::class, 'sell']);

Route::get('/profile',
[ProfileController::class, 'index']);

Route::post('/profile/update',
[ProfileController::class, 'update']);

Route::get('/wallet',
[WalletController::class, 'index']);

Route::post('/wallet/topup',
[WalletController::class, 'topup']);

Route::get('/history',
[HistoryController::class, 'index']);

Route::get('/history/{id}',
[HistoryController::class, 'show']);

Route::get('/locations',
[LocationController::class, 'index']);

Route::post('/locations/add',
[LocationController::class, 'store']);

Route::post('/locations/default/{id}',
[LocationController::class, 'setDefault']);

Route::get('/marketplace',
[MarketplaceController::class, 'index']);


// pengamanan akses user(middleware untuk user)
Route::middleware(['myauth'])->group(function () {

    Route::get('/logout',
    [AuthController::class, 'logout']);

    Route::post('/gacha/{machine}',
    [GachaController::class, 'gacha']);

    Route::get('/album',
    [AlbumController::class, 'index']);

    Route::post('/sell/{id}',
    [AlbumController::class, 'sell']);

    Route::get('/profile',
    [ProfileController::class, 'index']);

    Route::post('/profile/update',
    [ProfileController::class, 'update']);

    Route::get('/wallet',
    [WalletController::class, 'index']);

    Route::post('/wallet/topup',
    [WalletController::class, 'topup']);

    Route::get('/history',
    [HistoryController::class, 'index']);

    Route::get('/history/{id}',
    [HistoryController::class, 'show']);

    Route::get('/locations',
    [LocationController::class, 'index']);

    Route::post('/locations/add',
    [LocationController::class, 'store']);

    Route::post('/locations/default/{id}',
    [LocationController::class, 'setDefault']);

    Route::get('/cart',
    [CartController::class, 'index']);

    Route::post('/cart/add/{id}',
    [CartController::class, 'add']);

    Route::post('/checkout',
    [CartController::class, 'checkout']);

    Route::get('/buy-now/{id}',
    [CartController::class, 'buyNow']);

    Route::post('/buy-now/checkout/{id}',
    [CartController::class, 'buyNowCheckout']);

    Route::post('/cart/delete/{id}',
    [CartController::class, 'delete']);

    Route::post('/cart/increase/{id}',
    [CartController::class, 'increase']);

    Route::post('/cart/decrease/{id}',
    [CartController::class, 'decrease']);

    Route::get('/orders',
    [CartController::class, 'orders']);

    Route::get('/orders/{id}',
    [CartController::class, 'orderDetail']);

});

// pengamanan akses admin(middleware untuk admin)
Route::middleware(['admin'])->group(function () {

    // Admin product routes
    Route::get('/admin/products/create', [MarketplaceController::class, 'create']);
    Route::post('/admin/products', [MarketplaceController::class, 'store']);
    Route::get('/admin/products/{id}/edit', [MarketplaceController::class, 'edit']);
    Route::post('/admin/products/{id}/update', [MarketplaceController::class, 'update']);
    Route::post('/admin/products/{id}/delete', [MarketplaceController::class, 'destroy']);

    // Admin settings
    Route::get('/admin/settings', [\App\Http\Controllers\AdminController::class, 'index']);
    Route::post('/admin/settings', [\App\Http\Controllers\AdminController::class, 'update']);

});
Route::get('/cart',
[CartController::class, 'index']);

Route::post('/cart/add/{id}',
[CartController::class, 'add']);

Route::post('/checkout',
[CartController::class, 'checkout']);

Route::get('/buy-now/{id}',
[CartController::class, 'buyNow']);

Route::post('/buy-now/checkout/{id}',
[CartController::class, 'buyNowCheckout']);

Route::post('/cart/delete/{id}',
[CartController::class, 'delete']);

Route::post('/cart/increase/{id}',
[CartController::class, 'increase']);

Route::post('/cart/decrease/{id}',
[CartController::class, 'decrease']);

Route::get('/orders',
[CartController::class, 'orders']);

Route::get('/orders/{id}',
[CartController::class, 'orderDetail']);