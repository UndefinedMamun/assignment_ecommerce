<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/','WelcomeController@index');
Route::get('/manufacturer-product/{id}','WelcomeController@manufacturer_product');
Route::get('/category-product/{id}','WelcomeController@category_product');
Route::get('/product-details/{name}','WelcomeController@product_details');
Route::get('/admin','AdminController@index');
Route::post('/admin-login-check','AdminController@admin_log_in_check');

Route::post('/add-to-cart','CartController@add_to_cart');
Route::get('/show-cart','CartController@show_cart');
Route::get('/remove-product-from-cart/{id}','CartController@remove_product_from_cart');
Route::get('/update-qty/{qty_id}','CartController@update_qty');

Route::get('/dashboard','SupperAdminController@dashboard');

Route::get('/add-category','SupperAdminController@add_category');
Route::post('/save-category','SupperAdminController@save_category');
Route::get('/manage-category','SupperAdminController@manage_category');
Route::get('/unpublished-category/{id}','SupperAdminController@unpublished_category');
Route::get('/published-category/{id}','SupperAdminController@published_category');
Route::get('/edit-category/{id}','SupperAdminController@edit_category');
Route::post('/update-category','SupperAdminController@update_category');
Route::get('/delete-category/{id}','SupperAdminController@delete_category');

Route::get('/add-manufacturer','SupperAdminController@add_manufacturer');
Route::post('/save-manufacturer','SupperAdminController@save_manufacturer');
Route::get('/manage-manufacturer','SupperAdminController@manage_manufacturer');
Route::get('/unpublished-manufacturer/{id}','SupperAdminController@unpublished_manufacturer');
Route::get('/published-manufacturer/{id}','SupperAdminController@published_manufacturer');
Route::get('/edit-manufacturer/{id}','SupperAdminController@edit_manufacturer');
Route::post('/update-manufacturer','SupperAdminController@update_manufacturer');
Route::get('/delete-manufacturer/{id}','SupperAdminController@delete_manufacturer');

Route::get('/manage-product','SupperAdminController@manage_product');
Route::get('/add-product','SupperAdminController@add_product');
Route::post('/save-product','SupperAdminController@save_product');
Route::post('/update-product','SupperAdminController@update_product');
Route::get('/unpublished-product/{id}','SupperAdminController@unpublished_product');
Route::get('/published-product/{id}','SupperAdminController@published_product');
Route::get('/edit-product/{id}','SupperAdminController@edit_product');
Route::get('/delete-product/{id}','SupperAdminController@delete_product');


Route::get('/logout','SupperAdminController@logout');