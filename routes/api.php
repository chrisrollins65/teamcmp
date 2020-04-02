<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('profile', 'ApiController@getProfile');
Route::get('friend', 'ApiController@getIsFriend');
Route::post('friend', 'ApiController@postFriend');
Route::delete('friend', 'ApiController@deleteFriend');
Route::get('chat', 'ApiController@getChat');
Route::post('chat/message', 'ApiController@postChatMessage');
Route::get('avatars', 'ApiController@getAvatars');
