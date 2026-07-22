<?php

use App\Http\Controllers\MainController;
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

Route::get('/index', [MainController::class, 'index']);
Route::get('/about', [MainController::class, 'about']);

Route::redirect('/saltar', '/index');
Route::permanentRedirect('/saltar2', '/index');

Route::view('/view', 'welcome');
Route::view('/view2', 'welcome', ['name' => 'Aislan Penha']);

// ---------------------------------------------
// ROUTE PARAMETERS
// ---------------------------------------------
Route::get('/valor/{value}', [MainController::class, 'mostrarValor']);
Route::get('/valores/{value1}/{value2}', [MainController::class, 'mostrarValores']);
Route::get('/valores2/{value1}/{value2}', [MainController::class, 'mostrarValores2']);

Route::get('/opcional/{value?}', [MainController::class, 'mostrarValorOpcional']);
Route::get('/opcional1/{value1}/{value2?}', [MainController::class, 'mostrarValorOpcional1']);

Route::get('/user/{user_id}/post/{post_id}', [MainController::class, 'mostrarPosts']);

// ---------------------------------------------
// ROUTE PARAMETERS WITH CONSTRAINSTS
// ---------------------------------------------
// Route::get('/exp1/{value}', function($value) {
//     echo $value;
// })->where('value', '[0-9]+');
Route::get('/exp1/{value}', function($value) {
    echo $value;
})->whereNumber('value');

// Route::get('/exp2/{value}', function($value) {
//     echo $value;
// })->where('value', '[A-Za-z0-9]+');

Route::get('/exp2/{value}', function($value) {
    echo $value;
})->whereAlphaNumeric('value');

// Route::get('/exp3/{id}/{name}', function($value1, $value2) {
//     echo "ID: $value1 e NAME: $value2";
// })->where([
//     'id'   => '[0-9]+',
//     'name' => '[A-Za-z]+'
// ]);

Route::get('/exp3/{id}/{name}', function ($value1, $value2) {
    echo "ID: $value1 e NAME: $value2";
})->whereNumber('id')->whereAlpha('name');
