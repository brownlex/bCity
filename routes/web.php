<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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


Route::group(['namespace' => 'App\Http\Controllers'], function () {
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('home.dashboard');
Route::get('/link/{links}', [App\Http\Controllers\LinkController::class, 'destroy'])->name('link.destroy');
Route::get('/create/clients', [App\Http\Controllers\ClientController::class, 'create'])->name('clients.create');
Route::get('/display/clients', [App\Http\Controllers\ClientController::class, 'index'])->name('clients.index');
Route::get('/queue/clients', [App\Http\Controllers\ClientController::class, 'queue'])->name('clients.queue');
Route::get('/{client}/show/clients', [App\Http\Controllers\ClientController::class, 'show'])->name('clients.show');
Route::post('/data/clients', [App\Http\Controllers\ClientController::class, 'store'])->name('clients.store');
Route::post('/data/links', [App\Http\Controllers\LinkController::class, 'store'])->name('links.store');
Route::get('/create/contacts', [App\Http\Controllers\ContactController::class, 'create'])->name('contacts.create');
Route::get('/display/contacts', [App\Http\Controllers\ContactController::class, 'index'])->name('contacts.index');
Route::get('/queue/contacts', [App\Http\Controllers\ContactController::class, 'queue'])->name('contacts.queue');
Route::get('/{contact}/show/contacts', [App\Http\Controllers\ContactController::class, 'show'])->name('contacts.show');
Route::post('/data/contacts', [App\Http\Controllers\ContactController::class, 'store'])->name('contacts.store');

});