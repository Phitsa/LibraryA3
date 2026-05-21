<?php

use App\Http\Controllers\LivroController;
use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('livros.index'));

// Acervo de livros
Route::resource('livros', LivroController::class)->only(['index', 'create', 'store', 'show']);

// Empréstimos e devoluções
Route::get('/emprestimos',              [EmprestimoController::class, 'index'])->name('emprestimos.index');
Route::get('/emprestimos/novo',         [EmprestimoController::class, 'create'])->name('emprestimos.create');
Route::post('/emprestimos',             [EmprestimoController::class, 'store'])->name('emprestimos.store');
Route::patch('/emprestimos/{emprestimo}/devolver', [EmprestimoController::class, 'devolver'])->name('emprestimos.devolver');

// Fila de reservas (FIFO Queue)
Route::post('/reservas',                [EmprestimoController::class, 'reservar'])->name('reservas.store');

// Usuários
Route::resource('usuarios', UsuarioController::class)->only(['index', 'create', 'store', 'show']);
