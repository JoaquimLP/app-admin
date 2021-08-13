<?php

use App\Http\Controllers\{
    EmpresaController,
    FinanceiroController,
    HomeController,
    ProdutoController,
    UsuariosController,
};
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
    return redirect()->route('home');
});

Auth::routes();
Route::get('register', function () {
    return redirect()->route('usuario.index');
});
//Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->namespace('Admin')->middleware('auth')->group(function(){
    Route::get('/empresa/cliente', [EmpresaController::class, 'index'])->name('empresa.cliente.index');
    Route::get('/empresa/create/cliente', [EmpresaController::class, 'create'])->name('empresa.cliente.create');
    Route::post('/empresa/store', [EmpresaController::class, 'store'])->name('empresa.store');
    Route::get('/empresa/{id}/editar', [EmpresaController::class, 'edit'])->name('empresa.edit');
    Route::put('/empresa/{id}/update', [EmpresaController::class, 'update'])->name('empresa.update');
    Route::get('/empresa/{id}/show', [EmpresaController::class, 'show'])->name('empresa.show');
    Route::delete('/empresa/{id}/destroy', [EmpresaController::class, 'destroy'])->name('empresa.destroy');

    Route::get('/empresa/fornecedor', [EmpresaController::class, 'index'])->name('empresa.fornecedor.index');
    Route::get('/empresa/create/fornecedor', [EmpresaController::class, 'create'])->name('empresa.fornecedor.create');

    Route::get('/empresa/produto', [ProdutoController::class, 'index'])->name('produto.index');
    Route::get('/empresa/produto/create', [ProdutoController::class, 'create'])->name('produto.create');
    Route::post('/empresa/produto/store', [ProdutoController::class, 'store'])->name('produto.store');
    Route::get('/empresa/produto/{id}/editar', [ProdutoController::class, 'edit'])->name('produto.edit');
    Route::put('/empresa/produto/{id}/update', [ProdutoController::class, 'update'])->name('produto.update');
    Route::get('/empresa/produto/{id}/show', [ProdutoController::class, 'show'])->name('produto.show');
    Route::delete('/empresa/produto/{id}/destroy', [ProdutoController::class, 'destroy'])->name('produto.destroy');
    Route::any('/empresa/produto/search', [ProdutoController::class, 'search'])->name('produto.search');


    Route::get('/empresa/usuario', [UsuariosController::class, 'index'])->name('usuario.index');
    Route::get('/empresa/usuario/create', [UsuariosController::class, 'create'])->name('usuario.create');
    Route::post('/empresa/usuario/store', [UsuariosController::class, 'store'])->name('usuario.store');
    Route::get('/empresa/usuario/{id}/editar', [UsuariosController::class, 'edit'])->name('usuario.edit');
    Route::put('/empresa/usuario/{id}/update', [UsuariosController::class, 'update'])->name('usuario.update');
    Route::get('/empresa/usuario/{id}/show', [UsuariosController::class, 'show'])->name('usuario.show');
    Route::delete('/empresa/usuario/{id}/destroy', [UsuariosController::class, 'destroy'])->name('usuario.destroy');
    Route::any('/empresa/usuario/search', [UsuariosController::class, 'search'])->name('usuario.search');

    Route::get('/empresa/financeiro', [FinanceiroController::class, 'index'])->name('financeiro.index');
    Route::get('/empresa/financeiro/create', [FinanceiroController::class, 'create'])->name('financeiro.create');
    Route::post('/empresa/financeiro/store', [FinanceiroController::class, 'store'])->name('financeiro.store');
    Route::get('/empresa/financeiro/{id}/editar', [FinanceiroController::class, 'edit'])->name('financeiro.edit');
    Route::put('/empresa/financeiro/{id}/update', [FinanceiroController::class, 'update'])->name('financeiro.update');
    Route::get('/empresa/financeiro/{id}/show', [FinanceiroController::class, 'show'])->name('financeiro.show');
    Route::delete('/empresa/financeiro/{id}/destroy', [FinanceiroController::class, 'destroy'])->name('financeiro.destroy');
    Route::any('/empresa/financeiro/search', [FinanceiroController::class, 'search'])->name('financeiro.search');
    Route::post('/empresa/financeiro/buscar', [FinanceiroController::class, 'empresa'])->name('financeiro.empresa');
});
