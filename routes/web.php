<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


$app->group(['prefix' => 'api/v1', 'middleware' => 'api'], function($app) {
	$app->post('addproductuser/{product_id}', 'UserController@addproduct');
	$app->post('deleteproductuser/{product_id}', 'UserController@deleteproduct');
	$app->post('addproduct', [
	    'as' => 'product', 'uses' => 'ProductController@add'
	]);
	$app->post('updateproduct/{id}', [
	    'as' => 'product', 'uses' => 'ProductController@update'
	]);
	$app->post('deleteproduct/{id}', [
	    'as' => 'product', 'uses' => 'ProductController@delete'
	]);
});

$app->group(['prefix' => 'api/v1'], function($app) {
	$app->get('users', 'UserController@list_users');
	$app->get('user', 'UserController@list_user');

	$app->get('allproducts', 'ProductController@all');
	$app->get('product/{id}', 'ProductController@get');
});