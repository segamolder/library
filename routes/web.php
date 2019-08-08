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

Route::get('/books/getall', 'Books@getAllBooks')->name('getAllBooks');
Route::get('/librarian/get/author', 'AuthorController@getAuthors')->name('getAuthors');
Route::get('/librarian/get/category', 'CategoryController@getCategories')->name('getCategories');


Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'Auth\LoginController@login');
});

Route::group(['middleware' => 'auth'], function () {

    //admin
    Route::group(['middleware' => 'librarian'], function () {
        Route::get('/librarian/addauthor', function () {
           return view('librarian/addauthor');
        });

        Route::get('/librarian/addcategory', function () {
            return view('librarian/addcategory');
        });

        Route::get('/librarian/addbook', function () {
            return view('librarian/addbook');
        });

        Route::get('/librarian/books', function () {
            return view('librarian/books');
        });

        Route::post('/librarian/set/author', 'AuthorController@setAuthor');
        Route::post('/librarian/set/category', 'CategoryController@setCategory');

        Route::post('/librarian/set/book', 'Books@addBook');
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index');
