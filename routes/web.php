<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChurchController;
use App\Http\Controllers\BaptismalController;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'baptismal', 'middleware' => 'auth'], function(){
	Route::get('/', [BaptismalController::class, 'index']);	
	Route::get('/create', [BaptismalController::class, 'create']);	
});

Route::group(['prefix' => 'church', 'middleware' => 'auth'], function(){
	Route::get('/', [ChurchController::class, 'index']);	
	Route::post('/', [ChurchController::class, 'store']);
	Route::get('/edit/{id}', [ChurchController::class, 'edit']);
	Route::patch('/update/{id}', [ChurchController::class, 'update']);
	Route::delete('/delete/{id}', [ChurchController::class, 'destroy']);
});