<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::check()) {
            return redirect('/');
        }
        $validated = $request->validate([
            'email' => 'required|email:rfc,dns',
            'password' => 'required|min:6',
        ]);
        if (Auth::attempt($validated)) {
            $user = User::where('email', $request->email)->get();
            foreach($user as $row){
                session(['user.id' => $row->id]);
                session(['user.name' => $row->name]);
            }
            $success['token'] = $request->user()->createToken('MyApp')->accessToken;
            return redirect('/');
        }
        return back()->withErrors([
            'login_error' => 'Неверный логин или пароль. Пожалуйста, попробуйте снова.'
        ]);
    }

    public function register(Request $request)
    {
        //Проверка аунтифицирован ли пользователь
        if (Auth::check()) {
            return redirect('/');
        }
        //валидация данных
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);
        //добавление в бд
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        //аунтефикация пользователя
        Auth::login($user);
        if ($user) {
            $user = User::where('email', $request->email)->get();
            foreach($user as $row){
                $request->session()->push('user.id', $row->id);
                $request->session()->push('user.name', $row->name);
            }
            $success['token'] = $request->user()->createToken('MyApp')->accessToken;
            return redirect('/');
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }

    }
    public function logout(Request $request)
    {
        
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect('/');
    }
}
