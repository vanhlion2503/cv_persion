<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class Anhcontroller extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('Backend.Blog.anh', compact('user'));
    }
}
