<?php
include "./config.php";
include ROOT . '/vendor/autoload.php';

use Nesc\Router\Route;

Route::get('/displayProducts', 'productController@display');

Route::view('/addProduct', 'pages/addProducts.html');

Route::post('/displayProducts', 'productController@add');

Route::post('/deleteProducts', 'productController@delete');

Route::view('/register', 'pages/register.html');

Route::view('/signIn', 'pages/signIn.html');

Route::view('/', 'pages/home.html');

Route::post('/addUser', 'userController@add');

Route::get('/displayUsers', 'userController@display');

Route::post('/compareUsers', 'userController@compareUsers');
