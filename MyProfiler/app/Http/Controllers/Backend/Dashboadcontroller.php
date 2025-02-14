<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class Dashboadcontroller extends Controller
{
    public function __construct(){
    }

    public function index(){
        $user = Auth::user();
        return view("Backend.DashBoard.index",compact('user'));
    }
}
