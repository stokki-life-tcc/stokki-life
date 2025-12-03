<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\AcessosController;
use App\Http\Controllers\ContasController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ProdutoController; // <-- adicionei aqui

// Página inicial (abre o welcome)
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Rota explícita para /welcome
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome.page');

// Área autenticada
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Vendas
    Route::get('/vendas', [VendaController::class, 'index'])->name('vendas.index');
    Route::get('/vendas/create', [VendaController::class, 'create'])->name('vendas.create');
    Route::post('/vendas', [VendaController::class, 'store'])->name('vendas.store');

    // Estoque
    Route::get('/estoque', [EstoqueController::class, 'index'])->name('estoque.index');
    Route::post('/estoque', [EstoqueController::class, 'store'])->name('estoque.store');

    // Produtos (rota que estava faltando)
    Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');

    // Acessos
    Route::get('/acessos', [AcessosController::class, 'index'])->name('acessos.index');

    // Contas a Receber
    Route::get('/contas', [ContasController::class, 'index'])->name('contas.index');
    Route::put('/contas/{id}', [ContasController::class, 'update'])->name('contas.update');

    // Perfil
    Route::get('/perfil', [PerfilController::class, 'edit'])->name('perfil.edit');
    Route::put('/perfil', [PerfilController::class, 'update'])->name('perfil.update');

    // Logout
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    })->name('logout');
});

// Login e Registro
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
