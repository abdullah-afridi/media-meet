<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes([
    'register' => false,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
    Route::get('/user_form', [App\Http\Controllers\UserController::class, '__form'])->name('user_form');
    Route::post('/register_user', [App\Http\Controllers\UserController::class, 'registerUser'])->name('register_user');
    
    
    Route::get('/meeting', [App\Http\Controllers\MeetingController::class, 'index'])->name('meeting');
    Route::get('/meeting_form/{id?}', [App\Http\Controllers\MeetingController::class, '__form'])->name('meeting_form');
    Route::get('/meeting_delete/{id?}', [App\Http\Controllers\MeetingController::class, '__delete'])->name('meeting_delete');
    Route::post('/create_meeting', [App\Http\Controllers\MeetingController::class, 'store'])->name('create_meeting');
    Route::post('/update_meeting', [App\Http\Controllers\MeetingController::class, 'update'])->name('update_meeting');
    Route::get('/meeting_attendees/{id?}', [App\Http\Controllers\MeetingController::class, 'getMeetingDetails'])->name('meeting_attendees');


});