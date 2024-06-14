<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CatelogueController;
use App\Http\Controllers\Admin\ProductController;

// Route::get('/', function () {
//     return 'Đây là trang Dashboard!';
// });

Route::prefix('admin')
    ->as('admin.')
    ->group(function () {
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');
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
        Route::resource('products',ProductController::class);    
    });
?>