<?php

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

Route::get('/entrar', function () {
    return view('welcome');
});
Route::get('/', function () {
    return view('index');
});

$router->get('/home', 'Controller@home');

//Certificados Renato Lucena.
$router->get('/certificados', 'CertificadoController@index');
$router->get('/links', 'Controller@links');

//Laravel 20Cheatsheet
//$router->get('/laravel', 'LaravelController@laravel.html');
Route::get('/laravel', function () {
    return File::get(public_path() . '/html/laravel.html');
});

//contador
Route::get('/contador', function () {
    return File::get(public_path() . '/contador/ontador.txt');
});


$router->get('/rota', function () use ($router) {
    //return $router->app->version();
    return '<h1>Minha rota teste</h1>';
});

$router->get('/contato', 'ContatoController@contato');
$router->get('/teste', 'ContatoController@teste');
//$router->get('/teste', 'TesteController@listadb');

// Teste de email via cron
$router->get('/ExampleEmail', 'ContatoController@ExampleEmail');


//Route::post('/send', 'EmailController@send');
//Route::post('/notify', 'EmailController@notify');
//Route::group(['middleware' => ['web']], function () {
//});

// Email related routes
Route::get('mail/send', 'MailController@send');


// rotas para excel teste
Route::get('importExport', 'MaatwebsiteDemoController@importExport');

Route::get('importExport2', 'MaatwebsiteDemoController@importExport');

Route::get('downloadExcel/{type}', 'MaatwebsiteDemoController@downloadExcel');

Route::post('importExcel', 'MaatwebsiteDemoController@importExcel');

// outra rota de excel para teste
Route::get('/export_excel', 'ExportExcelController@index');

Route::get('/export_excel/excel', 'ExportExcelController@excel')->name('export_excel.excel');


// Observers
Route::get('/product', 'ProductController@create');
Route::post('/product', 'ProductController@store');

//
Auth::routes();

Route::get('/home1', 'HomeController@index')->name('home1');


// vue js com lumen
Route::get('/login_vue', 'AuthController@login')->name('login_vue');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// uploads
Route::group(['middleware' => 'auth'], function () {
    Route::get('files', 'FileEntriesController@index');
    Route::get('files/create', 'FileEntriesController@create');
    Route::post('files/upload-file', 'FileEntriesController@uploadFile');
    Route::get('files/{path_file}/{file}', function($path_file = null, $file = null) {
        $path = storage_path().'/files/uploads/'.$path_file.'/'.$file;
        if(file_exists($path)) {
            return Response::download($path);
        }
    });
});
