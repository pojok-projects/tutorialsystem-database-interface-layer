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
    $app->post('content/metadata/search', 'ContentMetadataController@search');
    $app->post('content/metadata/update/{id}', 'ContentMetadataController@update');
    $app->post('content/metadata/delete/{id}', 'ContentMetadataController@delete');

    // Content Category
    $app->get('content/category', 'ContentCategoryController@index');
    $app->post('content/category/store', 'ContentCategoryController@store');
    $app->get('content/category/{id}', 'ContentCategoryController@show');
    $app->post('content/category/search', 'ContentCategoryController@search');
    $app->post('content/category/update/{id}', 'ContentCategoryController@update');
    $app->post('content/category/delete/{id}', 'ContentCategoryController@delete');

    // Content Comment
    $app->get('content/comment/metadata/{id}', 'ContentCommentController@index');
    $app->post('content/comment/store', 'ContentCommentController@store');
    $app->get('content/comment/{id}', 'ContentCommentController@show');
    $app->post('content/comment/update/{id}', 'ContentCommentController@update');
    $app->post('content/comment/delete/{id}', 'ContentCommentController@delete');     
});