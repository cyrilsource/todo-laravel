<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//create new categorie
Route::post('categorie', 'CategorieController@store');

//delete a categorie
Route::delete('categorie/{id}', 'CategorieController@destroy');

//todos list
Route::get('todos', 'TodoController@index');

//create new todo
Route::post('todo/{categorie_id}/{val}', 'TodoController@store');

//delete a todo
Route::delete('todo/{id}', 'TodoController@destroy');

