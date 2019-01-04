<?php

use Illuminate\Http\Request;
use App\Events\MessagePushed;
use App\Message;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/send', function(Request $request) {
    $message = new Message();
    $message->text = $request->text;
    $message->receiver_id = $request->receiver_id;
    $message->sender_id = $request->sender_id;
    event(new MessagePushed($message));    
});
