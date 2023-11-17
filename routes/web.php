<?php

use App\Http\Controllers\NetworkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\wallet\DepositViewController;
use App\Http\Controllers\wallet\TransactionViewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard1', function () {
    return view('dashboard', [
        'user' => auth()->user()
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/packs/achat', \App\Http\Controllers\ValidationAchatPack::class)->name('packs.achat');

Route::resource('packs', \App\Http\Controllers\Pack\PackController::class);

// KYC
Route::middleware(['auth', 'verified'])->group(function (){
    Route::get('/kyc/create', \App\Livewire\KycForm::class)->name('kyc.create');
});


Route::get('/dashboard', [DashController::class, 'index'])
    ->name('dash')->middleware(['auth', 'verified']);


//TransactionView
Route::middleware(['auth'])->group(function(){
   Route::get('/transaction', [TransactionViewController::class, 'index'])->name('transaction.list');
});

//DepositView
Route::middleware(['auth'])->group(function(){
    Route::get('/deposit', [DepositViewController::class, 'index'])->name('deposit.index');
    Route::get('/deposit/link', [DepositViewController::class,'displayPaymentlink'])->name('deposit.link');
    Route::post('/deposit', [DepositViewController::class, 'store'])->name('deposit.store');
});

//NetworkView
Route::middleware(['auth'])->group(function(){
    Route::get('/network', [NetworkController::class, 'index'])->name('network.index');
});

//PackageView

//WithdrawView

require __DIR__.'/auth.php';
