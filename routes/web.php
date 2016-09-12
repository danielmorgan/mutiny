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

Route::get('/', 'UserController@location')->name('location');
Route::get('ship/{ship?}', 'ShipController@ship')->name('ship');
Route::get('profile/{user?}', 'UserController@profile')->name('profile');
Route::get('wallet', 'WalletController@page')->name('wallet');
Route::get('settings', 'UserController@settings')->name('settings');
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
Route::post('testshippa/{ship}', 'NotificationController@testShipPA')->name('testshippa');

// Wallet Actions
Route::post('wallet/transfer', 'WalletController@transfer');

// User Actions
Route::post('move-cancel', 'UserController@cancelMove')->name('move.user.cancel');
Route::post('move/{location}', 'UserController@move')->name('move.user.location');

// Model bindings
Route::bind('ship', function($value) {
    return \App\Ships\Ship::where('name', str_replace('-', ' ', $value))->first();
});
Route::bind('room', function($value) {
    return \App\Rooms\Room::where([
        ['type', $value],
        ['ship_id', Auth::user()->ship->id],
    ])->first();
});
Route::bind('user', function($value) {
    return \App\User::where('name', str_replace('-', ' ', $value))->first();
});
