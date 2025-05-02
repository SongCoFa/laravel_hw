<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegisterForm() {
        return view('register');
    }

    public function postRegister(Request $request) {
        // 驗證資料
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        try {
            // 嘗試註冊邏輯
            $user = new User();
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->password = bcrypt($validatedData['password']);
            $user->save();

            return response()->json(['message' => '註冊成功'], 201);
        } catch (\Exception $e) {
            // 捕捉錯誤並返回詳細訊息
            return response()->json(['error' => '註冊失敗', 'message' => $e->getMessage()], 500);
        }

        // Auth::login($user);
        // return redirect('/');
    }

    public function showLoginForm() {
        return view('login');
    }

    public function postLogin(Request $request) {
        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('/');
        }

        return back()->withErrors(['password' => '帳號或密碼錯誤']);
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}
