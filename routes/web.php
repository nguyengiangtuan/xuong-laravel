<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\CatelogueController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')
    ->as('admin.')
    ->group(function () {
        Route::prefix('catelogues')
            ->as('catelogues.')
            ->group(function () {
                Route::get('/',                 [CatelogueController::class, 'index'])->name('index');
                Route::get('create',            [CatelogueController::class, 'create'])->name('create');
                Route::post('store',            [CatelogueController::class, 'store'])->name('store');
                Route::get('show/{id}',         [CatelogueController::class, 'show'])->name('show');
                Route::get('{id}/edit',         [CatelogueController::class, 'edit'])->name('edit');
                Route::put('{id}/update',       [CatelogueController::class, 'update'])->name('update');
                Route::delete('{id}/destroy',   [CatelogueController::class, 'destroy'])->name('destroy');
            });
    });

Route::post('cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('cart', [CartController::class, 'index'])->name('cart.index');
