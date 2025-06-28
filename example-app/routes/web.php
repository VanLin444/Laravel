<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
// Добавление моего контроллера
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProjectController;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

// Мои роутеры
Route::get('/post', [PostController::class, 'getPost']);
// Создание записи в таблице
Route::get('/post/create', [PostController::class, 'createPost']);
// Изменение записи в таблице
Route::get('/post/update', [PostController::class, 'updatePost']);

Route::get('/project', [ProjectController::class, 'getProject']);

Route::get('/mypage', [MyPageController::class, 'index']);
//

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
