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

Route::get('/', function () {
    return view('welcome');
});

Route::get('user/{id}','UserController@show');

Route::get('user/action/{action}','UserController@action')->where('action','[A-Za-z]+');

//Route::get('user/test/','UserController@testcookie');
//设置cookie
Route::get('cookie/add', function () {
    $minutes = 24 * 60;
    return response('欢迎来到 Laravel 学院')->cookie('name', '学院君', $minutes);
});
//打印cookie
Route::get('cookie/get', function(\Illuminate\Http\Request $request) {
    $cookie = $request->cookie('name');
    dd($cookie);
});

Route::get('greeting', function () {
    return view('hello', ['name' => '学院君']);
});

Route::any('/admin/login', 'Admin\AdminController@login');
Route::any('/admin/code', 'Admin\AdminController@code');


Route::group(['middleware'=>['admin.login'],'prefix'=>'admin','namespace'=>'Admin'],function (){
//Route::middleware(['admin.login',])->group(function () {
    Route::any('index', 'IndexController@index');
    Route::any('info', 'IndexController@info');
    Route::any('quit', 'AdminController@quit');
    Route::any('pass', 'IndexController@pass');

    Route::resource('category','CategoryController');
});


Route::get('/layouts',function (){
    return view('layouts');
});

Route::get('/view','UserController@view');

Route::get('/dic','UserController@dic');