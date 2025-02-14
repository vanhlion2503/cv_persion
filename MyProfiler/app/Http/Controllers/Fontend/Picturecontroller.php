<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Social;

class Picturecontroller extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $links = Social::all();
        return view('Fontend.Picture.picture', compact('user', 'links'));
    }
}
