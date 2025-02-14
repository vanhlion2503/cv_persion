<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Social;
use App\Models\Post;
use App\Models\User;
class Blogcontroller extends Controller
{
    public function index($id = null)
    {
        // Nếu không có ID được truyền vào, lấy thông tin người dùng hiện tại
        if ($id) {
            $user = User::find($id);
            if (!$user) {
                abort(404, 'User not found');
            }
        } else {
            $user = Auth::user();
        }

        // Lấy tất cả liên kết mạng xã hội
        $links = Social::all();
        $posts = $user->posts;

        return view('Fontend.Blog.blog', compact('user', 'links', 'posts'));
    }
}

