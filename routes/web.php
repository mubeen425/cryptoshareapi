<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;


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
    return view('welcome');
});
Route::middleware('web')->group(function () {
    Route::post('/register-user', [RegisterController::class, 'register']);// The custom registration method
});

// Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register'); // Assuming you have a showRegistrationForm method for displaying the registration form

