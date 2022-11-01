<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Route::fallback(function(){
    return view('fallback.404');
    });

Auth::routes();

Route::get('/home', [App\Http\Controllers\LivroController::class, 'index'])->name('home');
Route::resource('autor','App\Http\Controllers\AutorController')->middleware('auth');
Route::resource('genero','App\Http\Controllers\GeneroController')->middleware('auth');
Route::resource('livro','App\Http\Controllers\LivroController')->middleware('auth');
Route::resource('autoria','App\Http\Controllers\AutoriaController')->middleware('auth');
Route::patch('livro/addPaginas/{livro}','App\Http\Controllers\LivroController@addPaginas')->name('livro.addPaginas')->middleware('auth');
Route::get('livro/iniciar/{livro}','App\Http\Controllers\LivroController@iniciar')->name('livro.iniciar')->middleware('auth');
Route::get('livro/desistir/{livro}','App\Http\Controllers\LivroController@desistir')->name('livro.desistir')->middleware('auth');
Route::get('livro/reler/{livro}','App\Http\Controllers\LivroController@reler')->name('livro.reler')->middleware('auth');
Route::get('livro/reler/{livro}','App\Http\Controllers\LivroController@reler')->name('livro.reler')->middleware('auth');



