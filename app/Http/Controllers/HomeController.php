<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class HomeController extends Controller
{
    public function getIndex()
    {
        $data = [];
        $messages = Message::paginate(10);
        $data = [
            'messages' => $messages->items(),
            'pagination' => [
                'total' => $messages->total(),
                'per_page' => $messages->perPage(),
                'current_page' => $messages->currentPage(),
                'last_page' => $messages->lastPage(),
                'next_page_url' => $messages->nextPageUrl(),
                'prev_page_url' => $messages->previousPageUrl(),
            ],
        ];
        return view('welcome', $data);

        // $data=[];
        // return view('welcome', $data);
    }

    // 取得留言列表
    public function getMessages(Request $request)
    {
        //$messages = Message::all(); // 取得所有留言

        $data = [];
        $perPage = 10;
        $page = request()->query('mypage');
        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });
        $messages = Message::orderBy('created_at', 'desc')->paginate($perPage);
        $data = [
            'messages' => $messages->items(),
            'pagination' => [
                'total' => $messages->total(),
                'per_page' => $messages->perPage(),
                'current_page' => $messages->currentPage(),
                'last_page' => $messages->lastPage(),
                'next_page_url' => $messages->nextPageUrl(),
                'prev_page_url' => $messages->previousPageUrl(),
            ],
        ];
        return response()->json($data);
    }

    // 新增一筆留言
    public function postMessages(Request $request)
    {
        $max = 25;
        $min = 1;

        $rules = [
            'username_from' => ['required', 'string', 'max:' . $max, 'min:'. $min],
            'username_to' => ['required', 'string', 'max:' . $max],
            'userid_to' => ['required', 'alpha_num', 'max:' . $max],
            'userid_from' => ['required', 'alpha_num', 'max:' . $max, 'min:'. $min],
            'title' => ['required', 'string'],
            'content' => ['required', 'string'],
        ];

        $validated = $request->validate($rules);

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
