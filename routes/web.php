<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PSBController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/clear_cache', function () {

    \Artisan::call('cache:clear');
    // \Artisan::call('permission:cache-reset');
    \Artisan::call('config:clear');

    dd("Cache is cleared");

});

// 9PSB API 
Route::get('/authenticate', [PSBController::class, 'authenticate'])->name('login');

// Home 
Route::get('/', [CustomerController::class, 'loginPage'])->name('login');
Route::get('/home', [CustomerController::class, 'index'])->name('home');
Route::post('/zainbox_live', [CustomerController::class, 'merchantDeposit']);

// FCMB Account 
Route::get('/create_fcmb_account', [CustomerController::class, 'createFCMBAccount'])->name('fcmb');

// SignUp 
Route::get('/signup', [CustomerController::class, 'signUpPage'])->name('signup');
Route::post('/signup/submit', [CustomerController::class, 'signUpForm'])->name('signupform');

// Login 
Route::get('/login', [CustomerController::class, 'loginPage'])->name('login');
Route::post('/login', [CustomerController::class, 'loginForm'])->name('loginform');
Route::get('/logout', [CustomerController::class, 'logout'])->name('logout');

//Forgot Password
Route::get('/forgot/password', [CustomerController::class, 'forgotPassword'])->name('forgot-password');
Route::post('/forgot/password', [CustomerController::class, 'forgotPasswordForm'])->name('forgot-password-form');

// Customer 
Route::prefix('dashboard')->group(function(){
    // Pages 
    Route::get('/index', [CustomerController::class, 'dashboard'])->name('cust-dashboard')->middleware('auth:web');
    Route::get('/wallet', [CustomerController::class, 'wallet'])->name('cust-wallet')->middleware('auth:web');
    Route::get('/transactions', [CustomerController::class, 'transactions'])->name('cust-transactions')->middleware('auth:web');
    Route::get('/customers', [CustomerController::class, 'customers'])->name('cust-page')->middleware('auth:web');
    Route::get('/account', [CustomerController::class, 'account'])->name('cust-account')->middleware('auth:web');
    Route::get('/support', [CustomerController::class, 'support'])->name('cust-support')->middleware('auth:web');
    Route::get('/privacy/policy', [CustomerController::class, 'privacyPolicy'])->name('privacy-policy')->middleware('auth:web');
    Route::get('/account/delete', [CustomerController::class, 'accountDelete'])->name('account-delete')->middleware('auth:web');
    Route::patch('/account/delete/{id}', [CustomerController::class, 'accountDeleteConfirmed'])->name('account-delete-confirmed')->middleware('auth:web');

    // Purchase 
    Route::post('/data/purchase', [CustomerController::class, 'dataPurchase'])->name('cust-data-purchase')->middleware('auth:web');
    Route::post('/airtime/purchase', [CustomerController::class, 'airtimePurchase'])->name('cust-airtime-purchase')->middleware('auth:web');
    Route::post('/electricity/search/meter', [CustomerController::class, 'electricitySearchMeter'])->name('cust-electricity-search-meter')->middleware('auth:web');
    Route::post('/electricity/purchase', [CustomerController::class, 'electricityPurchase'])->name('cust-electricity-purchase')->middleware('auth:web');
    
    // Transaction 
    Route::get('/transaction/view', [CustomerController::class, 'transactionView'])->name('cust-transaction-view')->middleware('auth:web');
    
    // Customer 
    Route::get('/customer/view', [CustomerController::class, 'customerView'])->name('cust-view')->middleware('auth:web');
    Route::post('/customer/fund/wallet', [CustomerController::class, 'customerFundWallet'])->name('cust-fund-wallet')->middleware('auth:web');
    
    // Forms 
    Route::post('/account/password', [CustomerController::class, 'accountPassword'])->name('cust-account-password')->middleware('auth:web');
    Route::post('/account/pin', [CustomerController::class, 'accountPin'])->name('cust-account-pin')->middleware('auth:web');
});
