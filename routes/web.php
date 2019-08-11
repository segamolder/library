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
    Route::post('/librarian/set/issue', 'StudentController@requestBook');
    Route::get('/librarian/get/issue', 'StudentController@getRequestedBooks');
    Route::get('/student/requestedbooks', function () {
        return view('requestedbooks');
    })->name('requestedbooks');

    //admin
    Route::group(['middleware' => 'librarian'], function () {
        Route::get('/librarian/addauthor', function () {
           return view('librarian/addauthor');
        })->name('addauthor');

        Route::get('/librarian/requestedbooks', function () {
           return view('librarian/librarianrequestedbooks');
        })->name('librarianrequestedbooks');

        Route::get('/librarian/addcategory', function () {
            return view('librarian/addcategory');
        })->name('addcategory');

        Route::get('/librarian/addbook', function () {
            return view('librarian/addbook');
        })->name('addbook');

        Route::get('librarian/addstudent', function() {
           return view('librarian/addstudent');
        })->name('addstudent');

        Route::get('librarian/libraryinfo', function() {
           return view('librarian/libraryinfo');
        })->name('libraryinfo');

        Route::get('/librarian/books', function () {
            return view('librarian/books');
        })->name('books');

        Route::get('/librarian/students', function () {
            return view('librarian/students');
        })->name('students');

        Route::post('/librarian/set/author', 'AuthorController@setAuthor');
        Route::post('/librarian/delete/author', 'AuthorController@deleteAuthor');
        Route::post('/librarian/set/category', 'CategoryController@setCategory');
        Route::post('/librarian/delete/category', 'CategoryController@deleteCategory');

        Route::post('/librarian/set/book', 'Books@addBook');
        Route::post('/librarian/update/book', 'Books@editBook');
        Route::post('/librarian/delete/book', 'Books@deleteBook');

        Route::get('/librarian/get/users', 'StudentController@getUsers');
        Route::get('/librarian/get/students', 'StudentController@getStudents');
        Route::get('/librarian/get/allrequestedbooks', 'StudentController@getAllRequestedBooks');
        Route::get('/info/getall', 'Books@getInfo');

        Route::post('/librarian/set/student', 'StudentController@setStudent');
        Route::post('/librarian/update/issue', 'StudentController@giveOut');
        Route::put('/librarian/update/issue', 'StudentController@return_book');
        Route::post('/librarian/delete/issue', 'StudentController@cancel_book');
    });
});

Auth::routes();
Route::get('/student/isstudent', 'StudentController@isStudent');
Route::get('/home', 'HomeController@index') -> name("home");
