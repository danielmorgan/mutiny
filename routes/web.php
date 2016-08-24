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

Route::get('/', 'HomeController@index');

Route::get('manifest.json', function() {
    return new \Illuminate\Http\JsonResponse([
        'name' => 'mutiny',
        'gcm_sender_id' => config('services.gcm.sender_id'),
    ]);
});

Route::get('testmail', function() {
    Mail::raw('This is a test...', function ($message) {
        $message->from(config('mail.from.address'), config('mail.from.name'));
        $message->to('me@danielmorgan.co.uk', 'Daniel Morgan');
        $message->subject('A message from our sponsors');
    });
});
