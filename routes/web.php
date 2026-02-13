<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LmsController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

use App\Models\PaymentMethod;

Route::get('/learn', function () {
    $paymentMethods = PaymentMethod::where('is_active', true)->get();
    return view('learn', compact('paymentMethods'));
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

// Password Reset Routes (Placeholder for now)
Route::get('password/reset', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('password/email', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('password/reset/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('password/reset', [AuthController::class, 'resetPassword'])->name('password.update');

use App\Http\Controllers\OrderController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\BrokerController;

// Secure Student Area
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/courses', [DashboardController::class, 'courses'])->name('dashboard.courses');

    // LMS Routes
    Route::get('/join-class/{id}', [LmsController::class, 'joinClass'])->name('lms.join');
    Route::get('/dashboard/learning-stats', [LmsController::class, 'myStats'])->name('dashboard.stats');
});

Route::post('/order/submit', [OrderController::class, 'store'])->name('order.submit');
Route::get('/order/success', [OrderController::class, 'success'])->name('order.success');

use App\Http\Controllers\SignalController;
use App\Http\Controllers\Admin\LmsController as AdminLmsController;

// Admin Area
Route::redirect('/admin', '/admin/dashboard');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');

    // Admin LMS
    Route::get('/lms/classes', [AdminLmsController::class, 'classes'])->name('lms.classes');
    Route::post('/lms/classes', [AdminLmsController::class, 'createClass'])->name('lms.classes.store');
    Route::delete('/lms/classes/{id}', [AdminLmsController::class, 'deleteClass'])->name('lms.classes.delete');
    Route::get('/lms/attendance/{id}', [AdminLmsController::class, 'attendance'])->name('lms.attendance');
    Route::get('/lms/student-stats', [AdminLmsController::class, 'studentStats'])->name('lms.student_stats');

    Route::post('/order/{id}', [App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('order.update');
    Route::delete('/order/{id}', [App\Http\Controllers\Admin\OrderController::class, 'destroy'])->name('orders.destroy');

    // Signal Management
    Route::resource('signals', SignalController::class);

    // User Management
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::post('users/{user}/impersonate', [UserController::class, 'impersonate'])->name('users.impersonate');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Payment Methods
    Route::resource('payment-methods', PaymentMethodController::class);

    // Brokers
    Route::resource('brokers', BrokerController::class);

    // Messaging & Inquiries
    Route::get('/messages', [App\Http\Controllers\Admin\InquiryController::class, 'messages'])->name('messages.index');
    Route::get('/consultations', [App\Http\Controllers\Admin\InquiryController::class, 'consultations'])->name('consultations.index');
    Route::delete('/messages/{id}', [App\Http\Controllers\Admin\InquiryController::class, 'destroyMessage'])->name('messages.destroy');
    Route::delete('/consultations/{id}', [App\Http\Controllers\Admin\InquiryController::class, 'destroyConsultation'])->name('consultations.destroy');

    // Site Settings
    Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
});

Route::post('/consultation', [App\Http\Controllers\ConsultationController::class, 'store'])->name('consultation.store');

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
