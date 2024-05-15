<?php

use App\Events\testingEvent;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

// Route::get('/test', function () {
//     event(new testingEvent);
//     return "done";
// });


Route::get('message', [MessageController::class, 'show'])->name('send.show');
Route::post('sendMessage', [MessageController::class, 'sendMessage'])->name('send.message');
Route::get('/', [MessageController::class, 'index'])->name('send.index');
