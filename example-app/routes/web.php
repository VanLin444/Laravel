<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
// Добавление моего контроллера
use App\Http\Controllers\MyPageController;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

// Мои роутеры
Route::get('/books', function() {
    return 'My books';
});

Route::get('/courses', function (){
    return 'My Courses';
});

Route::get('/projects', function () {
    return 'My projects';
});

Route::get('/mypage', [MyPageController::class, 'index']);
//

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
