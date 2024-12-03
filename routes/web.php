<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider and all of them 
| will be assigned to the "web" middleware group. Make something great!
|
*/

// Главная страница
Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index']);

// Страница Dashboard
Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__.'/auth.php';

// Страницы профиля
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Роуты для админа
    Route::group(['middleware' => ['role:admin']], function () {

        // Главная страница для администратора
        Route::get('/admin', function() {
            return view('admin');
        })->name('admin');

        // Страница с заявками администратора
        Route::get('/admin', 'App\Http\Controllers\AdminController@allData')->name('admin-data');
        Route::get('/admin/{id}', 'App\Http\Controllers\AdminController@showOneMessage')->name('admin-data-one');
        Route::post('/admin/{id}/update', 'App\Http\Controllers\AdminController@updateMessageSubmit')->name('admin-update-submit');
        Route::get('/admin/{id}/update', 'App\Http\Controllers\AdminController@updateMessage')->name('admin-update');
        Route::get('/admin/{id}/delete', 'App\Http\Controllers\AdminController@deleteMessage')->name('admin-delete');
    });

    // Роуты для админа и пользователя
    Route::group(['middleware' => ['role:admin|user']], function () {

        // Страница с контактами
        Route::get('/contact', [App\Http\Controllers\ContactController::class, 'submitForm'])->name('contact');
        Route::post('/contact', [ContactController::class, 'submit'])->name('contact-submit');
        Route::post('/contact/submit', 'App\Http\Controllers\ContactController@submit')->name('contact-form');
        Route::get('/contact/all', 'App\Http\Controllers\ContactController@allData')->name('contact-data');
        Route::get('/contact/all/{id}', 'App\Http\Controllers\ContactController@showOneMessage')->name('contact-data-one');

        // Страница пользователя
        Route::get('/userdata', 'App\Http\Controllers\ContactController@allDataUser')->name('user-data');
        Route::get('/userdata/{id}', 'App\Http\Controllers\ContactController@showOneMessageUser')->name('user-data-one');
        Route::post('/userdata/{id}/update', 'App\Http\Controllers\ContactController@updateMessageSubmit')->name('user-update-submit');
        Route::get('/userdata/{id}/update', 'App\Http\Controllers\ContactController@updateMessage')->name('user-update');
        Route::get('/userdata/{id}/delete', 'App\Http\Controllers\ContactController@deleteMessage')->name('user-delete');
    });

    // Роуты для категорий (только для админов)
    Route::group(['middleware' => ['role:admin']], function () {
        
        // Страница с категориями
        Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
        
        // Страница для добавления новой категории
        Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
        
        // Удаление категории
        Route::delete('/admin/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    });
});
