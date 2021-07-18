<?php

use App\Http\Controllers\TaskController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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


require __DIR__ . '/auth.php';

Route::domain(env('APP_URL'))->group(function () {
    Route::get('/', function () {
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    });

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    // タスク管理
    Route::get('/task', [TaskController::class, 'index'])->name('task');
    Route::get('/task/detail', [TaskController::class, 'detail'])->name('task.detail');
    Route::get('/task/form', [TaskController::class, 'form'])->name('task.form');
    Route::post('/task/done', [TaskController::class, 'done'])->name('task.done');
    Route::get('/task/delete/confirm', [TaskController::class, 'delete_confirm'])->name('task.delete_confirm');
    Route::post('/task/delete/done', [TaskController::class, 'delete_done'])->name('task.delete_done');
    Route::post('/task/update', [TaskController::class, 'update'])->name('task.update');
});
