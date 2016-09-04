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

Auth::routes();

Route::get('/', 'ShipController@location')->name('dashboard');
Route::get('room', 'ShipController@room')->name('room');
Route::get('ship/{ship?}', 'ShipController@ship')->name('ship');
Route::get('profile/{user?}', 'UserController@profile')->name('profile');
Route::get('wallet', 'WalletController@page')->name('wallet');
Route::get('admin', 'HomeController@admin');

Route::get('manifest.json', function() {
    return new \Illuminate\Http\JsonResponse([
        'name' => 'mutiny',
        'gcm_sender_id' => config('services.gcm.sender_id'),
    ]);
});

// Notifications
Route::post('notifications', 'NotificationController@store');
Route::get('notifications', 'NotificationController@index');
Route::get('notifications/last', 'NotificationController@last');
Route::patch('notifications/{id}/read', 'NotificationController@markAsRead');
Route::post('notifications/mark-all-read', 'NotificationController@markAllRead');
Route::post('notifications/{id}/dismiss', 'NotificationController@dismiss');

// Push Subscriptions
Route::post('subscriptions', 'PushSubscriptionController@update');
Route::post('subscriptions/delete', 'PushSubscriptionController@destroy');

// Admin Actions
Route::post('spamtest', 'NotificationController@spamTest');

// Wallet Actions
Route::post('wallet/transfer', 'WalletController@transfer');

// User Actions
Route::post('move/{room}', 'UserController@moveToRoom')->name('move.user.room');

// Model bindings
Route::bind('ship', function($value) {
    return \App\Ships\Ship::where('name', str_replace('-', ' ', $value))->first();
});
Route::bind('user', function($value) {
    return \App\User::where('name', str_replace('-', ' ', $value))->first();
});
