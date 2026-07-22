<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SingleActionController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\OnlyAdmin;
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

// ---------------------------------------------
// ROUTE NAMES
// ---------------------------------------------
Route::get('/rota_abc', function() {
    return 'Rota nomeada';
})->name('rota_nomeada');

Route::get('/rota_referenciada', function() {
    return redirect()->route('rota_nomeada');
});

Route::prefix('admin')->group(function() {
    Route::get('home', [MainController::class, 'index']);
    Route::get('about', [MainController::class, 'about']);
    Route::get('management/{value?}', [MainController::class, 'mostrarValorOpcional']);
});
/*
admin/home
admin/about
admin/management
*/

Route::get('admin/only', function() {
    echo 'Apenas administradores!';
})->middleware([OnlyAdmin::class]);

// Route::middleware([OnlyAdmin::class])->group(function() {
//     Route::get('admin/only1', function() {
//         return 'Apenas administradores 1!';
//     });
//     Route::get('admin/only2', function() {
//         return 'Apenas administradores 2!';
//     });
//     Route::get('admin/only3', function() {
//         return 'Apenas administradores 3!';
//     });
// });

Route::prefix('admin')
    ->middleware([OnlyAdmin::class])
    ->group(function() {
        Route::get('only1', function() {
            return 'Apenas administradores 1!';
        });
        Route::get('only2', function() {
            return 'Apenas administradores 2!';
        });
        Route::get('only3', function() {
            return 'Apenas administradores 3!';
        });
    });

// Route::controller(UserController::class)->group(function() {
//     Route::get('/user/new', 'new');
//     Route::get('/user/edit', 'edit');
//     Route::get('/user/delete', 'delete');
// });

Route::prefix('user')
    ->controller(UserController::class)
    ->group(function () {
        Route::get('new', 'new');
        Route::get('edit', 'edit');
        Route::get('delete', 'delete');
    });

Route::fallback(function() {
    echo "<h1>PÁGINA NÃO ENCONTRADA</h1>";
});

// Ordem mais comum
// Route::prefix('user')
//     ->name('user.')
//     ->middleware([OnlyAdmin::class])
//     ->controller(UserController::class)
//     ->group(function () {
//         Route::get('new', 'new')->name('new');
//         Route::get('edit', 'edit')->name('edit');
//         Route::get('delete', 'delete')->name('delete');
//     });

Route::get('/init_master', [MasterController::class, 'initMethod'])->name('init_master');
Route::get('/view_master', [MasterController::class, 'viewPage'])->name('view_master');

// route para controller single action
Route::get('/single', SingleActionController::class)->name('single');

// route para controller do tipo resource
// Route::resource('funcionarios', FuncionarioController::class);

Route::resources([
    'funcionarios' => FuncionarioController::class,
    'clientes'     => ClientController::class, 
    'produtos'     => ProductController::class
]);

Route::get('/teste/{value}', [MasterController::class, 'teste']);