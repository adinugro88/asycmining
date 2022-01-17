<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\InvestorController;
use App\Http\Controllers\MesinController;
use App\Http\Controllers\DatahasilController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MesinCRDController;
use App\Http\Livewire\MesinCrud;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::middleware(['is_admin'])->group(function () {
    Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::get('income', [IncomeController::class, 'adminHome'])->name('income');
    Route::get('admin/investor', [InvestorController::class, 'index'])->name('investor');
    Route::get('admin/mesin', [MesinController::class, 'index'])->name('mesin');
    Route::get('admin/mesin/{id}', [MesinCRDController::class, 'index'])->name('MesinCrud');
    Route::get('admin/income', [DatahasilController::class, 'index'])->name('incomenew');
    Route::get('admin/income/{id}', [DataHasilController::class, 'crud'])->name('incomecrud');
    Route::get('admin/payment', [PaymentController::class, 'index'])->name('payment');
}); 


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/coindate/{coin}/{tgld}', [App\Http\Controllers\HomeController::class, 'ubahcoindate'])->name('ubahtgl');

Route::get('/coin/{coin}', [App\Http\Controllers\HomeController::class, 'custom'])->name('btc');
Route::get('/btc/{tgld}', [App\Http\Controllers\HomeController::class, 'btctgl'])->name('btctgl');