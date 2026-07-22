<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// assinatura base de uma rota
// Route::verb('uri', callback); o callback é a ação que vai ser executada quando acionado.

// rota com função anônima
Route::get('/rota', function() {
    return '<h1>Olá Laravel!</h1>';
});

Route::get('/user', function() {
    return '<h1>Aqui está o usuário</h1>';
});

Route::get('/injection', function(Request $request) {
    var_dump($request);
});

Route::match(['get', 'post'], '/match', function(Request $request) {
    return '<h1>Aceita GET e POST</h1>';
});

Route::any('/any', function(Request $request) {
    return '<h1>Aceita qualquer http verb</h1>';
});

