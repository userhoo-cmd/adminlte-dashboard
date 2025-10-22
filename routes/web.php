<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController; // Move this to the top
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaymentController;

// 🌐 Language Switcher
Route::get('/locale/{lang}', function ($lang) {
    if (!in_array($lang, ['en', 'ms', 'zh'])) {
        abort(400); // invalid language
    }

    session(['locale' => $lang]);
    app()->setLocale($lang);

    return redirect()->back();
})->name('locale.switch');

Route::post('/language-switch', function (Illuminate\Http\Request $request) {
    $locale = $request->input('locale');
    Session::put('locale', $locale);
    App::setLocale($locale);
    return back();
})->name('language.switch');


// 🚪 Redirect homepage → login
Route::get('/', function () {
    return redirect()->route('login');
});

// 🔐 Auth routes (login, register, logout)
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login'); // Login page
Route::post('/login', [AuthenticatedSessionController::class, 'store']); // Handle login form submission
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout'); // Logout

// 🧱 Register routes
Route::get('register', [RegisteredUserController::class, 'create'])->name('register'); // Registration page
Route::post('register', [RegisteredUserController::class, 'store']); // Handle registration form submission

// 🧱 Password reset routes
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request'); // Forgot password page
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail']); // Send reset link
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset'); // Reset password form
Route::post('reset-password', [ResetPasswordController::class, 'reset']); // Handle reset password

// 🧱 Dashboard & Profile (requires authentication)
Route::middleware(['auth'])->group(function () {

    // 🏠 Dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); // Dashboard page

    // 👤 Profile routes
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // Edit profile page
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Update profile data

});
// Products



Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');



Route::get('lang/{locale}', function ($locale) {
    $languages = ['en','es','fr','de','it','pt','ru','ja','zh','ko','ms','th','vi','tr','nl','sv','pl'];

    if (in_array($locale, $languages)) {
        Session::put('locale', $locale);
        App::setLocale($locale);
    }

    return redirect()->back();
})->name('lang.switch');


