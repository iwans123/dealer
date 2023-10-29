<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Route::get('/items', function () {
//     return view('pages.items.main');
// })->middleware(['auth', 'verified'])->name('items');

Route::controller(ItemController::class)->prefix('item')->group(function () {
    Route::get('', 'index')->name('item');
    Route::get('create', 'create')->name('item.create');
    Route::post('create', 'store')->name('item.store');
    Route::get('edit/{id}', 'edit')->name('item.edit');
    Route::post('update/{id}', 'update')->name('item.update');
    Route::get('delete/{id}', 'destroy')->name('item.destroy');
});

Route::controller(CategoryController::class)->prefix('category')->group(function () {
    Route::get('', 'index')->name('category');
    Route::get('create', 'create')->name('category.create');
    Route::post('create', 'store')->name('category.store');
});


// Route::get('/items', [ItemController::class, 'index'])->name('items');
// Route::post('/items', [ItemController::class, 'store']);
// Route::delete('/items/{id}', [ItemController::class, 'destroy'])->name('items.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
