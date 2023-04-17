<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Livewire\KelolaPost;
use App\Http\Controllers\AdminController;


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
    return view('dashboard');
});

Route::get('/adminlogin', function () {
    return view('auth.adminlogin');
});



//laporan
Route::get('/laporan',[ReportController::class, 'render'])->middleware(['auth'])->name('laporan');
Route::post('/laporan',[ReportController::class, 'render'])->middleware(['auth'])->name('laporan');
Route::get('/show',[ReportController::class,'view'])->middleware(['auth'])->name('show');

Route::get('/dashboard',[HomeController::class,'render'])->name('dashboard');
require __DIR__.'/auth.php';

Route::get('/auth/google/callback', [GoogleAuthController::class,'RespondCallback'])->name('google.callback');

//google sign in
Route::get('/auth/google', function () {
    return Socialite::driver('google')->redirect();
  })->name('google.redirect');


Route::prefix('admin')->group(function () {

   Route::get('/kelola',[AdminController::class, 'ShowPost'])->middleware(['admin:admin'])->name('posts');
   Route::get('/kelola/{id}',KelolaPost::class)->middleware(['admin:admin'])->name('kelola');
   Route::get('/action',[AdminController::class, 'Action'])->middleware(['admin:admin'])->name('action');

});
