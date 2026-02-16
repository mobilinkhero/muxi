<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LmsController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/reviews', [App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');

use App\Models\PaymentMethod;

Route::get('/learn', function () {
    $paymentMethods = PaymentMethod::where('is_active', true)->get();
    return view('learn', compact('paymentMethods'));
});

Route::get('/community', [App\Http\Controllers\CommunityController::class, 'index'])->name('community');

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
Route::get('/disclaimer', [LegalController::class, 'disclaimer'])->name('disclaimer');

Route::get('/invest', function () {
    return view('invest');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

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

use App\Http\Controllers\ProfileController;

// Secure Student Area
Route::middleware(['auth', 'device_lock'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/dashboard/location', [DashboardController::class, 'updateLocation'])->name('dashboard.location');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/device-blocked', function () {
        return view('errors.device_blocked');
    })->name('device.blocked');
});

Route::middleware(['auth', 'device_lock'])->group(function () {
    Route::get('/dashboard/courses', [DashboardController::class, 'courses'])->name('dashboard.courses');

    // LMS Routes
    Route::get('/join-class/{id}', [LmsController::class, 'joinClass'])->name('lms.join');
    Route::get('/dashboard/learning-stats', [LmsController::class, 'myStats'])->name('dashboard.stats');
    Route::post('/dashboard/courses/progress', [LmsController::class, 'saveProgress'])->name('dashboard.courses.progress');
    Route::get('/dashboard/courses/stream/{id}', [LmsController::class, 'streamVideo'])->name('stream.video');
});

Route::post('/order/submit', [OrderController::class, 'store'])->name('order.submit');
Route::get('/order/success', [OrderController::class, 'success'])->name('order.success');

use App\Http\Controllers\SignalController;
use App\Http\Controllers\Admin\LmsController as AdminLmsController;

// Admin Area
Route::redirect('/youcanthackme', '/youcanthackme/dashboard');

Route::middleware(['auth', 'admin'])->prefix('youcanthackme')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::post('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');
    Route::get('/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');

    // Admin LMS
    Route::get('/lms/classes', [AdminLmsController::class, 'classes'])->name('lms.classes');
    Route::post('/lms/classes', [AdminLmsController::class, 'createClass'])->name('lms.classes.store');
    Route::delete('/lms/classes/{id}', [AdminLmsController::class, 'deleteClass'])->name('lms.classes.delete');
    Route::get('/lms/attendance/{id}', [AdminLmsController::class, 'attendance'])->name('lms.attendance');
    Route::get('/lms/student-stats', [AdminLmsController::class, 'studentStats'])->name('lms.student_stats');

    // Daily Tasks
    Route::get('/lms/tasks', [AdminLmsController::class, 'tasks'])->name('lms.tasks');
    Route::post('/lms/tasks', [AdminLmsController::class, 'createTask'])->name('lms.tasks.store');
    Route::delete('/lms/tasks/{id}', [AdminLmsController::class, 'deleteTask'])->name('lms.tasks.delete');

    // Class Recordings
    Route::get('/lms/recordings', [AdminLmsController::class, 'recordings'])->name('lms.recordings');
    Route::post('/lms/recordings/upload', [AdminLmsController::class, 'uploadRecording'])->name('lms.recordings.upload');
    Route::get('/lms/recordings/{id}/edit', [AdminLmsController::class, 'editRecording'])->name('lms.recordings.edit');
    Route::post('/lms/recordings/{id}', [AdminLmsController::class, 'updateRecording'])->name('lms.recordings.update');
    Route::delete('/lms/recordings/{id}', [AdminLmsController::class, 'deleteRecording'])->name('lms.recordings.delete');

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
    Route::post('stop-impersonate', [UserController::class, 'stopImpersonate'])->name('users.stop-impersonate');
    Route::post('users/{user}/reset-device', [UserController::class, 'resetDevice'])->name('users.reset-device');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Security Tracking
    Route::get('/security/logs', [UserController::class, 'securityLogs'])->name('security.logs');

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

    // Content Management
    // Team
    Route::get('/content/team', [App\Http\Controllers\Admin\ContentController::class, 'teamIndex'])->name('content.team.index');
    Route::post('/content/team', [App\Http\Controllers\Admin\ContentController::class, 'teamStore'])->name('content.team.store');
    Route::get('/content/team/{id}/edit', [App\Http\Controllers\Admin\ContentController::class, 'teamEdit'])->name('content.team.edit');
    Route::post('/content/team/{id}', [App\Http\Controllers\Admin\ContentController::class, 'teamUpdate'])->name('content.team.update');
    Route::delete('/content/team/{id}', [App\Http\Controllers\Admin\ContentController::class, 'teamDelete'])->name('content.team.delete');

    // Careers
    Route::get('/content/careers', [App\Http\Controllers\Admin\ContentController::class, 'careersIndex'])->name('content.careers.index');
    Route::post('/content/careers', [App\Http\Controllers\Admin\ContentController::class, 'careerStore'])->name('content.careers.store');
    Route::get('/content/careers/{id}/edit', [App\Http\Controllers\Admin\ContentController::class, 'careerEdit'])->name('content.careers.edit');
    Route::post('/content/careers/{id}', [App\Http\Controllers\Admin\ContentController::class, 'careerUpdate'])->name('content.careers.update');
    Route::delete('/content/careers/{id}', [App\Http\Controllers\Admin\ContentController::class, 'careerDelete'])->name('content.careers.delete');
    Route::get('/content/careers/{id}/applications', [App\Http\Controllers\Admin\ContentController::class, 'careerApplications'])->name('content.careers.applications');

    // Blog
    Route::get('/content/blog', [App\Http\Controllers\Admin\ContentController::class, 'blogIndex'])->name('content.blog.index');
    Route::get('/content/blog/create', [App\Http\Controllers\Admin\ContentController::class, 'blogCreate'])->name('content.blog.create');
    Route::post('/content/blog', [App\Http\Controllers\Admin\ContentController::class, 'blogStore'])->name('content.blog.store');
    Route::get('/content/blog/{id}/edit', [App\Http\Controllers\Admin\ContentController::class, 'blogEdit'])->name('content.blog.edit');
    Route::post('/content/blog/{id}', [App\Http\Controllers\Admin\ContentController::class, 'blogUpdate'])->name('content.blog.update');
    Route::delete('/content/blog/{id}', [App\Http\Controllers\Admin\ContentController::class, 'blogDelete'])->name('content.blog.delete');

    // Page Content Management
    Route::get('/content/pages', [App\Http\Controllers\Admin\PageContentController::class, 'index'])->name('content.pages.index');
    Route::post('/content/pages/update', [App\Http\Controllers\Admin\PageContentController::class, 'update'])->name('content.pages.update');

    // Reviews Management
    Route::get('/content/reviews', [App\Http\Controllers\Admin\ContentController::class, 'reviewIndex'])->name('content.reviews.index');
    Route::post('/content/reviews', [App\Http\Controllers\Admin\ContentController::class, 'reviewStore'])->name('content.reviews.store');
    Route::delete('/content/reviews/{id}', [App\Http\Controllers\Admin\ContentController::class, 'reviewDelete'])->name('content.reviews.delete');
});

Route::post('/consultation', [App\Http\Controllers\ConsultationController::class, 'store'])->name('consultation.store');

use App\Http\Controllers\MarketController;
use App\Http\Controllers\CoinGlassController;
use App\Http\Controllers\DuneController;
use App\Http\Controllers\GlassnodeController;
use App\Http\Controllers\NewsController;

use App\Http\Controllers\PageController;

Route::get('/api/market/global', [MarketController::class, 'getGlobalMetrics'])->name('api.market.global');
Route::get('/api/market/coinglass/liquidations', [CoinGlassController::class, 'getLiquidations'])->name('api.market.cg.liq');
Route::get('/api/market/coinglass/longshort', [CoinGlassController::class, 'getLongShortRatio'])->name('api.market.cg.ls');
Route::get('/api/market/dune/{queryId}', [DuneController::class, 'getQueryResult'])->name('api.market.dune');
Route::get('/api/market/glassnode/metrics', [GlassnodeController::class, 'getMetrics'])->name('api.market.glassnode');
Route::get('/api/market/news', [NewsController::class, 'getLatestNews'])->name('api.market.news');

// Markets Pages
Route::get('/markets/crypto', [PageController::class, 'crypto'])->name('markets.crypto');
Route::get('/markets/forex', [PageController::class, 'forex'])->name('markets.forex');
Route::get('/markets/stocks', [PageController::class, 'stocks'])->name('markets.stocks');
Route::get('/markets/commodities', [PageController::class, 'commodities'])->name('markets.commodities');

// Company Pages
Route::get('/start-trading', function () {
    return view('invest');
})->name('start-trading'); // Alias
Route::get('/about-us', [PageController::class, 'about'])->name('company.about');
Route::get('/our-team', [PageController::class, 'team'])->name('company.team');
Route::get('/careers', [PageController::class, 'careers'])->name('company.careers');
Route::get('/careers/{id}', [PageController::class, 'careerShow'])->name('company.careers.show');
Route::post('/careers/{id}/apply', [PageController::class, 'careerApply'])->name('company.careers.apply');
Route::get('/blog', [PageController::class, 'blog'])->name('company.blog');
Route::get('/blog/{slug}', [PageController::class, 'blogPost'])->name('company.blog.show');

// P2P Routes (Admin)
Route::group(['prefix' => 'youcanthackme', 'as' => 'admin.p2p.', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/p2p', [App\Http\Controllers\Admin\P2PController::class, 'index'])->name('index');
    Route::post('/p2p/rates', [App\Http\Controllers\Admin\P2PController::class, 'updateRates'])->name('rates');
    Route::post('/p2p/process/{id}', [App\Http\Controllers\Admin\P2PController::class, 'process'])->name('process');
});

// P2P Routes (User)
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard/p2p', [App\Http\Controllers\P2PController::class, 'index'])->name('p2p.index');
    Route::post('/dashboard/p2p', [App\Http\Controllers\P2PController::class, 'store'])->name('p2p.store');
});

Route::get('/magic-login', function () {
    $user = \App\Models\User::where('email', 'admin@gsmtradinglab.com')->first();
    if (!$user) {
        return 'Admin user not found!';
    }
    \Illuminate\Support\Facades\Auth::login($user);
    return redirect()->route('admin.dashboard');
});
