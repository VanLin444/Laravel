<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
// Добавление моего контроллера
use App\Http\Controllers\MainController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContactsController;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

// Группируем все контроллеры относящиеся к Post
Route::group(['namespace' => 'App\Http\Controllers\Post'], function () {
    Route::get('/post', 'IndexController')->name('post.index');
    Route::get('/post/create', 'CreateController')->name('post.create');
    Route::post('/post', 'StoreController')->name('post.store');
    Route::get('/post/{post}', 'ShowController')->name('post.show');
    Route::get('/post/{post}/edit', 'EditController')->name('post.edit');
    Route::patch('/post/{post}', 'UpdateController')->name('post.update');
    Route::delete('/post/{post}', 'DestroyController')->name('post.delete');
});
// BLADE - view
Route::get('/main', [MainController::class, 'index'])->name('main.index');
Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts.index');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');


Route::get('/project', [ProjectController::class, 'getProject']);
Route::get('/mypage', [MyPageController::class, 'index']);
//
/*
// Без группировки
Route::get('/post', [PostController::class, 'index'])->name('post.index');
Route::post('/post', [PostController::class, 'store'])->name('post.store');
Route::get('/post/{post}', [PostController::class, 'show'])->name('post.show');
Route::get('/post/create', [PostController::class, 'createPost'])->name('post.create');
Route::get('/post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
Route::patch('/post/{post}', [PostController::class, 'update'])->name('post.update');
Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('post.delete'); */

/* // Мои роутеры
// Чтение записей из таблицы
Route::get('/post/get', [PostController::class, 'getPost']);
// Изменение записи в таблице
Route::get('/post/update', [PostController::class, 'updatePost']);
// Удаление записей из таблицы
Route::get('/post/delete', [PostController::class, 'deletePost']);
// Чтение или создание записи
Route::get('/post/first_or_create', [PostController::class, 'firstOrCreate']);
// Обновление или создание записи
Route::get('/post/update_or_create', [PostController::class, 'updateOrCreate']); */

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
