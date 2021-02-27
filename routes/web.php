<?php

use Illuminate\Support\Facades\Auth;
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

// pagina inicio
Route::get('/', 'InicioController@index')->name('inicio.index');

// Mostrar las categorias
Route::get('/categoria/{categoriaReceta}', 'CategoriasController@show')->name('categorias.show');

Route::get('/recetas', 'RecetaController@index' )->name('recetas.index');
Route::get('/recetas/create', 'RecetaController@create')->name('recetas.create');
Route::post('/recetas', 'RecetaController@store')->name('recetas.store');
Route::get('/recetas/{receta}', 'RecetaController@show')->name('recetas.show');
Route::get('/recetas/{receta}/edit', 'RecetaController@edit')->name('recetas.edit');
Route::put('/recetas/{receta}', 'RecetaController@update')->name('recetas.update');
Route::delete('/recetas/{receta}', 'RecetaController@destroy')->name('recetas.destroy');

//Admin
Route::get('/admin', 'AdminController@index')->name('admin.index');
Route::get('/admin/{admin}/edit', 'AdminController@edit')->name('admin.edit');
Route::put('/admin/{admin}', 'AdminController@update')->name('admin.update');
Route::delete('/admin/{admin}', 'AdminController@destroy')->name('admin.destroy');


// Buscador de Receta
Route::get('/buscar', 'RecetaController@search')->name('buscar.show');

//Perfiles
Route::get('/perfiles/{perfil}', 'PerfilController@show')->name('perfiles.show');
Route::get('/perfiles/{perfil}/edit', 'PerfilController@edit')->name('perfiles.edit');
Route::put('/perfil/{perfil}', 'PerfilController@update')->name('perfiles.update');

// Almacen los likes de las recetas
Route::post('/recetas/{receta}', 'LikesController@update')->name('likes.update');

//Mostrar los me gusta del usuario
Route::get('/megusta', 'LikesController@index' )->name('recetas.megusta');

Route::get('/masvotadas', 'PopularController@index' )->name('recetas.popular');


Auth::routes();

