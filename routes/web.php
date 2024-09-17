<?php

use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('items')->group(function () {
    // 商品一覧ページのルート
    Route::get('/', [App\Http\Controllers\ItemController::class, 'index'])->name('items.index');

    // 商品登録のルート
    Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::post('/add', [App\Http\Controllers\ItemController::class, 'add']);

    // 商品編集のルート
    Route::get('/{id}/edit', [App\Http\Controllers\ItemController::class, 'edit'])->name('items.edit');
    Route::put('/{id}', [App\Http\Controllers\ItemController::class, 'update'])->name('items.update');

    // 商品削除のルート
    Route::delete('/{id}', [App\Http\Controllers\ItemController::class, 'delete'])->name('items.delete');

});
