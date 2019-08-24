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
    $app->get('content/metadata/{id}', 'ContentMetadataController@show');
    $app->post('content/metadata/search', 'ContentMetadataController@search');
    $app->post('content/metadata/store', 'ContentMetadataController@store');
    $app->post('content/metadata/update/{id}', 'ContentMetadataController@update');
    $app->post('content/metadata/delete/{id}', 'ContentMetadataController@delete');

    // Content Subtitle
    $app->get('content/subtitle', 'SubtitleController@index');
    $app->post('content/subtitle/store', 'SubtitleController@store');
    $app->get('content/subtitle/{id}', 'SubtitleController@show');
    $app->post('content/subtitle/search', 'SubtitleController@search');
    $app->post('content/subtitle/update/{id}', 'SubtitleController@update');
    $app->post('content/subtitle/delete/{id}', 'SubtitleController@delete');

    // Content Category
    $app->get('content/category', 'ContentCategoryController@index');
    $app->post('content/category/store', 'ContentCategoryController@store');
    $app->get('content/category/{id}', 'ContentCategoryController@show');
    $app->post('content/category/search', 'ContentCategoryController@search');
    $app->post('content/category/update/{id}', 'ContentCategoryController@update');
    $app->post('content/category/delete/{id}', 'ContentCategoryController@delete');

    // Content Playlists Category
    $app->get('content/playlists/category', 'PlaylistCategoryController@index');
    $app->post('content/playlists/category/store', 'PlaylistCategoryController@store');
    $app->get('content/playlists/category/{id}', 'PlaylistCategoryController@show');
    $app->post('content/playlists/category/search', 'PlaylistCategoryController@search');
    $app->post('content/playlists/category/update/{id}', 'PlaylistCategoryController@update');
    $app->post('content/playlists/category/delete/{id}', 'PlaylistCategoryController@delete');

    // User Route
    $app->get('user', 'UserController@index');
    $app->get('user/{id}', 'UserController@show');
    $app->post('user/store', 'UserController@store');
    $app->post('user/search', 'UserController@search');
    $app->post('user/update/{id}', 'UserController@update');
    $app->post('user/delete/{id}', 'UserController@delete');
});