<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactsController;

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

Route::group(['prefix' => '/', 'as' => 'contacts.'], function () {
    Route::get('/', [ContactsController::class, 'index'])->name('index');
    Route::get('/add-contact', [ContactsController::class, 'addContact'])->name('add-contact');
    Route::post('/store', [ContactsController::class, 'store'])->name('store');
});