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

Auth::routes();

Route::match(["GET", "POST"], "/register", function(){
    return redirect("/login");
    })->name("register");

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/helo', function(){
    return "HAlo apa kabarnya";
});


Route::get('/home', 'HomeController@index')->name('home');
Route::resource('users', 'UserController');

// route categories
Route::get('/categories/trash', 'CategoryController@trash')->name('categories.trash');
Route::get('/categories/{id}/restore', 'CategoryController@restore')->name('categories.restore');
Route::get('/categories/{category}/delete-permanent', 'CategoryController@deletePermanent')->name('categories.delete-permanent');
Route::resource('categories', 'CategoryController');

// route book
Route::get('/ajax/categories/search', 'CategoryController@ajaxSearch');
Route::get('/books/trash', 'BookController@trash')->name('books.trash');
Route::post('/books/{id}/restore', 'BookController@restore')->name('books.restore');
Route::delete('/books/{id}/delete-permanent', 'BookController@deletePermanent')->name('books.delete-permanent');
Route::resource('books', 'BookController');

// route order
Route::resource('orders', 'OrderController');
