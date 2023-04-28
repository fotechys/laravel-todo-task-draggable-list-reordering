<?php

use Illuminate\Support\Facades\Route;

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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::resource('/', App\Http\Controllers\ProjectController::class);
Route::resource('projects', App\Http\Controllers\ProjectController::class);
Route::get('tasks/filter', [\App\Http\Controllers\TaskController::class, 'index'])->name('tasks.filter');
Route::post('tasks/filter', [\App\Http\Controllers\TaskController::class, 'index'])->name('tasks.filter');
Route::resource('tasks', App\Http\Controllers\TaskController::class);
Route::post('tasks/ordering', [\App\Http\Controllers\TaskController::class, 'orderingRow'])->name('tasks.ordering');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



