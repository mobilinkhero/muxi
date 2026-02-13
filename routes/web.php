<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/learn', function () {
    return view('learn');
});

use App\Http\Controllers\TradeController;

Route::get('/trade', [TradeController::class, 'index']);

// Support & Legal Routes
use App\Http\Controllers\SupportController;
use App\Http\Controllers\LegalController;

Route::get('/contact', [SupportController::class, 'contact'])->name('contact');
Route::post('/contact', [SupportController::class, 'submitContact'])->name('contact.submit');
Route::get('/help', [SupportController::class, 'help'])->name('help');

Route::get('/privacy-policy', [LegalController::class, 'privacy'])->name('privacy');
Route::get('/terms-of-service', [LegalController::class, 'terms'])->name('terms');

Route::get('/invest', function () {
    return view('invest');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

use App\Http\Controllers\OrderController;

use App\Http\Controllers\AdminController;

// Secure Student Area
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/order/submit', [OrderController::class, 'store'])->name('order.submit');
});

use App\Http\Controllers\SignalController;

// Admin Area
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/order/{id}', [AdminController::class, 'updateStatus'])->name('admin.order.update');

    // Signal Management
    Route::resource('admin/signals', SignalController::class)->names([
        'index' => 'admin.signals.index',
        'create' => 'admin.signals.create',
        'store' => 'admin.signals.store',
        'edit' => 'admin.signals.edit',
        'update' => 'admin.signals.update',
        'destroy' => 'admin.signals.destroy',
    ]);
});

use App\Http\Controllers\MarketController;
use App\Http\Controllers\CoinGlassController;
use App\Http\Controllers\DuneController;
use App\Http\Controllers\GlassnodeController;
use App\Http\Controllers\NewsController;

Route::get('/api/market/global', [MarketController::class, 'getGlobalMetrics'])->name('api.market.global');
Route::get('/api/market/coinglass/liquidations', [CoinGlassController::class, 'getLiquidations'])->name('api.market.cg.liq');
Route::get('/api/market/coinglass/longshort', [CoinGlassController::class, 'getLongShortRatio'])->name('api.market.cg.ls');
Route::get('/api/market/dune/{queryId}', [DuneController::class, 'getQueryResult'])->name('api.market.dune');
Route::get('/api/market/glassnode/metrics', [GlassnodeController::class, 'getMetrics'])->name('api.market.glassnode');
Route::get('/api/market/news', [NewsController::class, 'getLatestNews'])->name('api.market.news');
