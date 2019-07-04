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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'v1/'], function ($app) {

    // Content Metadata
    $app->get('content/metadata', 'ContentMetadataController@index');
    $app->post('content/metadata/store', 'ContentMetadataController@store');
    $app->get('content/metadata/{id}', 'ContentMetadataController@show');
    $app->put('content/metadata/update/{id}', 'ContentMetadataController@update');
    $app->delete('content/metadata/delete/{id}', 'ContentMetadataController@delete');

    // Content Category
    $app->get('content/category', 'ContentCategoryController@index');
    $app->post('content/category/store', 'ContentCategoryController@store');
    $app->get('content/category/{id}', 'ContentCategoryController@show');
    $app->put('content/category/update/{id}', 'ContentCategoryController@update');
    $app->delete('content/category/delete/{id}', 'ContentCategoryController@delete');
});