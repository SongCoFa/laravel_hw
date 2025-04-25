<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class HomeController extends Controller
{
    public function getIndex()
    {
        $data=[];
        return view('welcome', $data);
    }

    public function getMessages()
    {
        return Message::all();
    }

    public function postMessages(Request $request)
    {
        $message = new Message();
        $message->username = $request->input('username');
        $message->title = $request->input('title');
        $message->content = $request->input('content');
        $message->save();

        return response()->json(['success' => true]);
    }
}
