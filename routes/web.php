<?php

use App\Http\Controllers\ProdutosController;
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

Route::get('/', function () {
    return view('welcome');
})->name("root");

Route::get('/produtos', [ProdutosController::class, "index"])->name("products.index");
Route::get('/produtos/tipo/{id}', [ProdutosController::class, "produtosPorTipo"])->name("products.by.type");
Route::post("/produtos", [ProdutosController::class, "store"])->name("products.store")->middleware("auth");
Route::get('/produtos/create',[ProdutosController::class, "create"])->name("products.create")->middleware("auth");
Route::get('/produtos/edit/{id}',[ProdutosController::class, "edit"])->name("products.edit")->middleware("auth");
Route::get('/produtos/{id}',[ProdutosController::class, "show"])->name("products.show");
Route::put('/produtos/{id}',[ProdutosController::class, "update"])->name("products.update");
Route::delete('/produtos/{id}',[ProdutosController::class, "destroy"])->name("products.destroy")->middleware("auth");

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
