<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
// Добавление моего контроллера
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ContactsController;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

// Мои роутеры
// Чтение записей из таблицы
Route::get('/post/get', [PostController::class, 'getPost']);
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

// BLADE - view
Route::get('/post', [PostController::class, 'index'])->name('post.index');
Route::get('/main', [MainController::class, 'index'])->name('main.index');
Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts.index');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');

// CRUD
Route::post('/post', [PostController::class, 'store'])->name('post.store');

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

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
