<?php

namespace App\Http\Controllers;

use App\Events\sendMessage;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $data["messages"] = Message::get();
        return view('welcome', $data);
    }

    public function show()
    {
        return view('message');
    }

    public function sendMessage(Request $request)
    {
        $message = Message::create(['messages' => $request->message]);
        event(new sendMessage($request->message));
        return redirect()->back();
    }
}