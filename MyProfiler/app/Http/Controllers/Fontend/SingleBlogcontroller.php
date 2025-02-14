<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Social;
use App\Models\Post;
use App\Models\User;
class SingleBlogcontroller extends Controller
{
    public function index($id = null)
    {
        $user = User::findOrFail($id);  // Tìm thông tin người dùng theo ID
        $links = Social::all();
        $posts = Post::where('user_id', $id)->get();  // Lấy các bài viết của user có ID tương ứng

        return view('Fontend.Blog.singleblog', compact('user', 'links', 'posts'));
    }

    // Hiển thị bài viết cụ thể
    public function show($userId, $postId)
    {
        $user = User::findOrFail($userId);  // Tìm thông tin người dùng
        $post = Post::findOrFail($postId);  // Kiểm tra bài viết thuộc người dùng đó
        $links = Social::all();

        return view('Fontend.Blog.singleblog', compact('user', 'post', 'links'));
    }
}
