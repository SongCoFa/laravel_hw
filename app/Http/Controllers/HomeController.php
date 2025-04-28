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

    // 取得留言列表
    public function getMessages()
    {
        $messages = Message::all(); // 取得所有留言
        return response()->json($messages);
    }

    // 新增一筆留言
    public function postMessages(Request $request)
    {
        $validated = $request->validate([
            'username_from' => 'required|string|max:255',
            'username_to' => 'required|string',
            'userid_to' => 'required|alpha_num',
            'userid_from' => 'required|alpha_num',
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $message = Message::create($validated);

        return response()->json($message, 201);
    }

    // 更新一筆留言
    public function updateMessages(Request $request)
    {
        $id = $request->input('id');
        $message = Message::findOrFail($id);

        $validated = $request->validate([
            'username_from' => 'required|string|max:255',
            'username_to' => 'required|string',
            'userid_to' => 'required|alpha_num',
            'userid_from' => 'required|alpha_num',
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $message->update($validated);

        return response()->json($message);
    }

    // 刪除一筆留言
    public function deleteMessages(Request $request)
    {
        $id = $request->input('id');
        $message = Message::findOrFail($id);
        $message->delete();

        return response()->json(null, 204);
    }
}
