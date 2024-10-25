<?php

use App\Http\Controllers\{
    AuthController,
    FlavorController,
    UserController
};
use Illuminate\Support\Facades\Route;

// Rotas de autenticação
Route::prefix('/auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
});

// Rotas para cadastro de usuários
Route::post('/cadastrar', [UserController::class, 'store']);

// Agrupamento de rotas protegidas por autenticação
Route::middleware('auth:api')->group(function () {

    // Grupo de rotas para usuários
    Route::prefix('/user')->group(function () {
        Route::get('/', [UserController::class, 'me']);
        Route::get('/listar', [UserController::class, 'index']);
        Route::put('/atualizar/{id}', [UserController::class, 'update']);
        Route::delete('/deletar/{id}', [UserController::class, 'destroy']);
        Route::get('/visualizar/{id}', [UserController::class, 'show']);
    });

    // Grupo de rotas para sabores
    Route::prefix('/sabor')->group(function () {
        Route::post('/', [FlavorController::class, 'store']);
        Route::get('/', [FlavorController::class, 'index']);
        Route::put('/atualizar/{id}', [FlavorController::class, 'update']);
        Route::delete('/deletar/{id}', [FlavorController::class, 'destroy']);
        Route::get('/visualizar/{id}', [FlavorController::class, 'show']);
    });
});
