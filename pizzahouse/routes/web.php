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
    return view('welcome');
});

Route::get('/pizzas', function () {
    return view('pizzas'); // return a view
    // return 'pizzas!;' // return a string and convert to text/html
    // return [name => 'veg pizza', 'base' => 'classic'] // return an array and it will convert it to a JSON  
});
