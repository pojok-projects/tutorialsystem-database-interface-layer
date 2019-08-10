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

    /**
     * Route Metadata, MetadataVideo, MetadataSubtitle
     */
    // Index Routes
    $app->get('content/metadata', 'ContentMetadataController@index');
    $app->get('content/metadata/video', 'ContentMetadataVideoController@index');
    $app->get('content/metadata/subtitle', 'ContentMetadataSubtitleController@index');

    // Show Routes
    $app->get('content/metadata/{id}', 'ContentMetadataController@show');
    $app->get('content/metadata/video/{id}', 'ContentMetadataVideoController@index');
    $app->get('content/metadata/subtitle/{id}', 'ContentMetadataSubtitleController@index');
    
    // Search Routes
    $app->post('content/metadata/search', 'ContentMetadataVideoController@search');
    $app->post('content/metadata/video/search', 'ContentMetadataVideoController@search');
    $app->post('content/metadata/subtitle/search', 'ContentMetadataSubtitleController@search');

    // Store Routes
    $app->post('content/metadata/store', 'ContentMetadataController@store');
    $app->post('content/metadata/video/store', 'ContentMetadataVideoController@store');
    $app->post('content/metadata/subtitle/store', 'ContentMetadataSubtitleController@store');

    // Update Routes
    $app->post('content/metadata/update/{id}', 'ContentMetadataController@update');
    $app->post('content/metadata/video/update/{id}', 'ContentMetadataVideoController@update');
    $app->post('content/metadata/subtitle/update/{id}', 'ContentMetadataSubtitleController@update');

    // Delete Routes
    $app->post('content/metadata/delete/{id}', 'ContentMetadataController@delete');
    $app->post('content/metadata/video/delete/{id}', 'ContentMetadataVideoController@delete');
    $app->post('content/metadata/subtitle/delete/{id}', 'ContentMetadataSubtitleController@delete');

    /**
     * Route Metadata, MetadataVideo, MetadataSubtitle
     */

    // Content Subtitle
    $app->get('content/subtitle', 'SubtitleController@index');
    $app->post('content/subtitle/store', 'SubtitleController@store');
    $app->get('content/subtitle/{id}', 'SubtitleController@show');
    $app->post('content/subtitle/search', 'SubtitleController@search');
    $app->post('content/subtitle/update/{id}', 'SubtitleController@update');
    $app->post('content/subtitle/delete/{id}', 'SubtitleController@delete');

    // Content Dislike
    $app->get('content/dislike', 'ContentDislikeController@index');
    $app->post('content/dislike/store', 'ContentDislikeController@store');
    $app->get('content/dislike/{id}', 'ContentDislikeController@show');
    $app->post('content/dislike/search', 'ContentDislikeController@search');
    $app->post('content/dislike/update/{id}', 'ContentDislikeController@update');
    $app->post('content/dislike/delete/{id}', 'ContentDislikeController@delete');

    // Content Like
    $app->get('content/like', 'ContentLikeController@index');
    $app->post('content/like/store', 'ContentLikeController@store');
    $app->get('content/like/{id}', 'ContentLikeController@show');
    $app->post('content/like/search', 'ContentLikeController@search');
    $app->post('content/like/update/{id}', 'ContentLikeController@update');
    $app->post('content/like/delete/{id}', 'ContentLikeController@delete');

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

    // Content Playlists & Category
    $app->get('content/playlists', 'PlaylistsController@index');
    $app->get('content/playlists/category', 'PlaylistCategoryController@index');

    $app->post('content/playlists/store', 'PlaylistsController@store');
    $app->post('content/playlists/category/store', 'PlaylistCategoryController@store');

    $app->get('content/playlists/{id}', 'PlaylistsController@show');
    $app->get('content/playlists/category/{id}', 'PlaylistCategoryController@show');

    $app->post('content/playlists/search', 'PlaylistsController@search');
    $app->post('content/playlists/category/search', 'PlaylistCategoryController@search');

    $app->post('content/playlists/update/{id}', 'PlaylistsController@update');
    $app->post('content/playlists/category/update/{id}', 'PlaylistCategoryController@update');

    $app->post('content/playlists/delete/{id}', 'PlaylistsController@delete');
    $app->post('content/playlists/category/delete/{id}', 'PlaylistCategoryController@delete');


    /**
     * User Route
     */

    // Index Routes
    $app->get('user', 'UserController@index');
    $app->get('user/following', 'UserFollowingController@index');
    $app->get('user/follower', 'UserFollowerController@index');
    $app->get('user/likevideo', 'UserLikeVideoController@index');
    $app->get('user/dislikevideo', 'UserDislikeVideoController@index');
    $app->get('user/savedvideo', 'UserSavedVideoController@index');
    $app->get('user/historyvideo', 'UserHistoryVideoController@index');
    $app->get('user/historyvideo/{id}', 'UserHistoryVideoController@show');

    // Show Routes
    $app->get('user/{id}', 'UserController@show');
    $app->get('user/following/{id}', 'UserFollowingController@show');
    $app->get('user/follower/{id}', 'UserFollowerController@show');
    $app->get('user/likevideo/{id}', 'UserLikeVideoController@show');
    $app->get('user/dislikevideo/{id}', 'UserDislikeVideoController@show');
    $app->get('user/savedvideo/{id}', 'UserSavedVideoController@show');

    // Store Routes
    $app->post('user/store', 'UserController@store');
    $app->post('user/following/store', 'UserFollowingController@store');
    $app->post('user/follower/store', 'UserFollowerController@store');
    $app->post('user/likevideo/store', 'UserLikeVideoController@store');
    $app->post('user/dislikevideo/store', 'UserDislikeVideoController@store');
    $app->post('user/savedvideo/store', 'UserSavedVideoController@store');
    $app->post('user/historyvideo/store', 'UserHistoryVideoController@store');

    // Search Routes
    $app->post('user/search', 'UserController@search');
    $app->post('user/following/search', 'UserFollowingController@search');
    $app->post('user/follower/search', 'UserFollowerController@search');
    $app->post('user/likevideo/search', 'UserLikeVideoController@search');
    $app->post('user/dislikevideo/search', 'UserDislikeVideoController@search');
    $app->post('user/savedvideo/search', 'UserSavedVideoController@search');
    $app->post('user/historyvideo/search', 'UserHistoryVideoController@search');

    // Update Routes
    $app->post('user/update/{id}', 'UserController@update');
    $app->post('user/following/update/{id}', 'UserFollowingController@update');
    $app->post('user/follower/update/{id}', 'UserFollowerController@update');
    $app->post('user/likevideo/update/{id}', 'UserLikeVideoController@update');
    $app->post('user/dislikevideo/update/{id}', 'UserDislikeVideoController@update');
    $app->post('user/savedvideo/update/{id}', 'UserSavedVideoController@update');
    $app->post('user/historyvideo/update/{id}', 'UserHistoryVideoController@update');

    // Delete Routes
    $app->post('user/delete/{id}', 'UserController@delete');
    $app->post('user/following/delete/{id}', 'UserFollowingController@delete');
    $app->post('user/follower/delete/{id}', 'UserFollowerController@delete');
    $app->post('user/likevideo/delete/{id}', 'UserLikeVideoController@delete');
    $app->post('user/dislikevideo/delete/{id}', 'UserDislikeVideoController@delete');
    $app->post('user/savedvideo/delete/{id}', 'UserSavedVideoController@delete');
    $app->post('user/historyvideo/delete/{id}', 'UserHistoryVideoController@delete');
    
});