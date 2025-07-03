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
// Чтение записей из таблицы
Route::get('/post', [PostController::class, 'getPost']);
// Создание записи в таблице
Route::get('/post/create', [PostController::class, 'createPost']);
// Изменение записи в таблице
Route::get('/post/update', [PostController::class, 'updatePost']);
// Удаление записей из таблицы
Route::get('/post/delete', [PostController::class, 'deletePost']);
// Чтение или создание записи
Route::get('/post/first_or_create', [PostController::class, 'firstOrCreate']);
// Обновление или создание записи
Route::get('/post/update_or_create', [PostController::class, 'updateOrCreate']);

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
