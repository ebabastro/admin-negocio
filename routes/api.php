<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas de las categorias (leer, guardar, eliminar ...)
Route::get('/getCategories', [CategoryController::class, 'index'])->name('getCategories');
Route::post('/storeCategory', [CategoryController::class, 'store'])->name('storeCategory');
Route::post('/deleteCategory', [CategoryController::class, 'delete'])->name('deleteCategory');
Route::post('/editCategory', [CategoryController::class, 'edit'])->name('editCategory');

// Rutas de las subcategorias (leer, guardar, eliminar ...)
Route::get('/getSubcategories', [SubcategoryController::class, 'index'])->name('getSubcategories');
Route::post('/storeSubcategory', [SubcategoryController::class, 'store'])->name('storeSubcategory');
Route::post('/deleteSubcategory', [SubcategoryController::class, 'delete'])->name('deleteSubcategory');
Route::post('/editSubcategory', [SubcategoryController::class, 'edit'])->name('editSubcategory');




// Rutas de los productos (leer, guardar, eliminar ...)
Route::get('/getProducts', [ProductController::class, 'index'])->name('getProducts');
Route::post('/storeProduct', [ProductController::class, 'store'])->name('storeProduct');
Route::post('/deleteProduct', [ProductController::class, 'delete'])->name('deleteProduct');
Route::post('/editProduct', [ProductController::class, 'edit'])->name('editProduct');