<?php

namespace App\Http\Controllers\Backend;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;

class BaivietController extends Controller
{
    // Bảo vệ các route bằng middleware auth
    public function __construct()
    {
    }

    // Hiển thị danh sách bài viết
    public function index()
    {
        $user = Auth::user();
        $posts = Post::where('user_id', $user->id)->latest()->paginate(5);
        return view('Backend.Blog.baiviet', compact('user', 'posts'));
    }

    // Lưu bài viết mới
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|max:255',
            'summary' => 'required',
            'content' => 'required',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageUrl = null;
        if ($request->hasFile('image')) {
            $imageUrl = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        }

        // Tạo bài viết mới
        Auth::user()->posts()->create([
            'title'   => $request->title,
            'summary' => $request->summary,
            'content' => $request->content,
            'image'   => $imageUrl,
        ]);

        return redirect()->route('baiviet.index')->with('success', 'Bài viết đã được tạo thành công.');
    }

    // Hiển thị form chỉnh sửa bài viết
    public function edit(Post $post)
    {

        $user = Auth::user();
        $posts = Post::latest()->paginate(5);
        return view('Backend.Blog.baiviet', compact('user', 'posts', 'post'));
    }

    // Cập nhật bài viết
    public function update(Request $request, Post $post)
    {

        $request->validate([
            'title'   => 'required|max:255',
            'summary' => 'required',
            'content' => 'required',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageUrl = $post->image; // Giữ ảnh cũ nếu không có ảnh mới

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ trên Cloudinary nếu có
            if ($post->image) {
                Cloudinary::destroy($post->image);
            }
            // Upload ảnh mới
            $imageUrl = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        }

        $post->update([
            'title'   => $request->title,
            'summary' => $request->summary,
            'content' => $request->content,
            'image'   => $imageUrl,
        ]);

        return redirect()->route('baiviet.index')->with('success', 'Bài viết đã được cập nhật.');
    }

    // Xóa bài viết
    public function destroy(Post $post)
    {

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('baiviet.index')->with('success', 'Bài viết đã được xóa.');
    }
}
