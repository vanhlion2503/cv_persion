<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Authrequest;  
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class Authcontroller extends Controller
{
    public function __construct(){
    }
    public function index(){
        return view("Backend.Auth.login");
    }
    public function showRegisterForm(){
        return view("Backend.Auth.register");
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        return redirect()->route('auth.admin')->with('success', 'Đăng ký thành công!');
    }
    public function login(Authrequest $request){
       if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        // Đăng nhập thành công
            return redirect()->route('darkboard.index')->with('success','Đăng nhập thành công');
        } else {
    // Đăng nhập thất bại
            return redirect()->route('auth.admin')->with('error','Đăng nhập thất bại');
        }   
    }
    public function logout(Request $request){
        Auth::logout(); 
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.admin');
    }
}
