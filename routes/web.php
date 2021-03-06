<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChurchController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\MarriageController;
use App\Http\Controllers\BaptismalController;
use App\Http\Controllers\ConfirmationController;
use App\Http\Controllers\FirstCommunionController;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'church', 'middleware' => 'auth'], function(){
	Route::get('/', [ChurchController::class, 'index']);	
	Route::post('/', [ChurchController::class, 'store']);
	Route::get('/edit/{id}', [ChurchController::class, 'edit']);
	Route::patch('/update/{id}', [ChurchController::class, 'update']);
	Route::delete('/delete/{id}', [ChurchController::class, 'destroy']);
});

Route::group(['prefix' => 'baptismal', 'middleware' => 'auth'], function(){
	Route::get('/', [BaptismalController::class, 'index']);	
	Route::get('/create', [BaptismalController::class, 'create']);
	Route::post('/', [BaptismalController::class, 'store']);
	Route::get('/edit/{id}', [BaptismalController::class, 'edit']);
	Route::patch('/update/{id}', [BaptismalController::class, 'update']);
	Route::delete('/delete/{id}', [BaptismalController::class, 'destroy']);
});

Route::group(['prefix' => 'first-communion', 'middleware' => 'auth'], function(){
	Route::get('/', [FirstCommunionController::class, 'index']);
	Route::get('/create', [FirstCommunionController::class, 'create']);
	Route::get('/create/{id}', [FirstCommunionController::class, 'fc_create']);	
	Route::post('/', [FirstCommunionController::class, 'store']);
	Route::get('/edit/{id}', [FirstCommunionController::class, 'edit']);
	Route::patch('/update/{id}', [FirstCommunionController::class, 'update']);
	Route::delete('/delete/{id}', [FirstCommunionController::class, 'destroy']);
});

Route::group(['prefix' => 'confirmation', 'middleware' => 'auth'], function(){
	Route::get('/', [ConfirmationController::class, 'index']);
	Route::get('/create', [ConfirmationController::class, 'create']);
	Route::get('/create/{id}', [ConfirmationController::class, 'c_create']);
	Route::post('/', [ConfirmationController::class, 'store']);
	Route::get('/edit/{id}', [ConfirmationController::class, 'edit']);
	Route::patch('/update/{id}', [ConfirmationController::class, 'update']);
	Route::delete('/delete/{id}', [ConfirmationController::class, 'destroy']);
});

Route::group(['prefix' => 'marriage', 'middleware' => 'auth'], function(){
	Route::get('/', [MarriageController::class, 'index']);
	Route::get('/create', [MarriageController::class, 'create']);
	Route::get('/show/{id}', [MarriageController::class, 'show']);
	Route::post('/', [MarriageController::class, 'store']);
	Route::get('/edit/{id}', [MarriageController::class, 'edit']);
	Route::patch('/update/{id}', [MarriageController::class, 'update']);
	Route::delete('/delete/{id}', [MarriageController::class, 'destroy']);
});

Route::group(['prefix' => 'import-records', 'middleware' => 'auth'], function(){
	Route::get('/', [ImportController::class, 'index']);
	Route::post('/baptismal', [ImportController::class, 'baptismal']);
	Route::post('/confirmation', [ImportController::class, 'confirmation']);
	Route::post('/first-communion', [ImportController::class, 'first_communion']);
});