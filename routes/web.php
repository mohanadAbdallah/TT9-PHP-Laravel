<?php

use App\Http\Controllers\ClassroomsController;
use App\Http\Controllers\ClassworkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopicController;
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
Route::get('users',[\App\Http\Controllers\AuthController::class,'users'])->name('users.show');

Route::middleware(['auth','verified'])->group(function () {

    Route::prefix('/classrooms/trashed')
        ->as('classrooms.')
        ->controller(ClassroomsController::class)
        ->group(function () {
            Route::get('/', 'trashed')->name('trashed');
            Route::put('/{classroom}', 'restore')->name('restore');
            Route::delete('/{classroom}', 'forceDelete')->name('force-delete');
        });

    Route::prefix('/topics/trashed')
        ->as('topics.')
        ->controller(TopicController::class)
        ->group(function () {
            Route::get('/', 'trashed')->name('trashed');
            Route::put('/{topic}', 'restore')->name('restore');
            Route::delete('/{topic}', 'forceDelete')->name('force-delete');
        });

    Route::resources([
        'topics' => TopicController::class,
        'classrooms'=>ClassroomsController::class,
        'classrooms.classworks'=>ClassworkController::class
    ]);



    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
