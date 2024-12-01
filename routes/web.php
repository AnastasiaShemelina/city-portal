<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('/admin', function() {
            return view('admin');
        });

        Route::get(
            '/admin',
            'App\Http\Controllers\AdminController@allData'
        )->name('admin-data');

        Route::get(
            '/admin/{id}',
            'App\Http\Controllers\AdminController@showOneMessage'
        )->name('admin-data-one');

        Route::post(
            '/admin/{id}/update',
            'App\Http\Controllers\AdminController@updateMessageSubmit'
        )->name('admin-update-submit');

        Route::get(
            '/admin/{id}/update',
            'App\Http\Controllers\AdminController@updateMessage'
        )->name('admin-update');

        Route::get(
            '/admin/{id}/delete',
            'App\Http\Controllers\AdminController@deleteMessage'
        )->name('admin-delete');
    });
    

    Route::group(['middleware' => ['role:admin|user']], function () {
    Route::get('/contact', function() {
        return view('contact');
    })->name('contact');
    
    Route::post(
        '/contact/submit', 
        'App\Http\Controllers\ContactController@submit'
        )->name('contact-form');
    
    Route::get(
        '/contact/all', 
        'App\Http\Controllers\ContactController@allData' 
    )->name('contact-data');
    
    Route::get(
        '/contact/all/{id}',
        'App\Http\Controllers\ContactController@showOneMessage'
    )->name('contact-data-one');

    Route::get(
        '/userdata',
        'App\Http\Controllers\ContactController@allDataUser'
    )->name('user-data');

    Route::get(
        '/userdata/{id}',
        'App\Http\Controllers\ContactController@showOneMessageUser'
    )->name('user-data-one');

    Route::post(
        '/userdata/{id}/update',
        'App\Http\Controllers\ContactController@updateMessageSubmit'
    )->name('user-update-submit');

    Route::get(
        '/userdata/{id}/update',
        'App\Http\Controllers\ContactController@updateMessage'
    )->name('user-update');

    Route::get(
        '/userdata/{id}/delete',
        'App\Http\Controllers\ContactController@deleteMessage'
    )->name('user-delete');
});
});








