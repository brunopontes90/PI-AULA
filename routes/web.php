<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\TagController;


require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => 'auth'], function(){
    //carrinho
});

// GRUPO DE ROTAS PARA AUTENTCIAR
Route::group(['middleware' => 'isAdmin'], function(){
    Route::resource('/product', ProductsController::class, ['except' => ['show']]);
    Route::get('/trash/product', [ProductsController::class, 'trash'])->name('product.trash');
    Route::patch('/product/restore/{id}', [ProductsController::class, 'restore'])->name('product.restore');
    Route::resource('/category', CategoriesController::class, ['except' => ['show']]);
    Route::resource('/tag', TagController::class, ['except' => ['show']]);
});

// ROTA PARA APENAS VISUALIZAR PRODUTOS SEM ESTAR LOGADO
Route::resource('/product', ProductsController::class, ['only' => ['show']]);
Route::resource('/category', CategoriesController::class, ['only' => ['show']]);
Route::resource('/tag', TagController::class, ['only' => ['show']]);
