<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Social;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    // Hiển thị danh sách các Social links của user hiện tại
    public function index()
    {
        $user = Auth::user();
        $links = $user->socials; // Lấy danh sách social của user đang đăng nhập
        return view('Backend.User.social', compact('user', 'links'));
    }

    // Thêm Social link mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'url'  => 'required|url|max:255'
        ]);

        Auth::user()->socials()->create([
            'name' => $request->name,
            'icon' => $request->icon,
            'url'  => $request->url,
        ]);

        return redirect()->route('social-links.index')->with('success', 'Link đã được thêm!');
    }

    // Cập nhật Social link (Chỉ user sở hữu link mới có thể sửa)
    public function update(Request $request, Social $socialLink)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'url'  => 'required|url|max:255'
        ]);

        $socialLink->update([
            'name' => $request->name,
            'icon' => $request->icon,
            'url'  => $request->url,
        ]);

        return redirect()->route('social-links.index')->with('success', 'Link đã được cập nhật!');
    }

    // Xóa Social link (Chỉ user sở hữu link mới có thể xóa)
    public function destroy(Social $socialLink)
    {
        $socialLink->delete();
        return redirect()->route('social-links.index')->with('success', 'Link đã bị xóa!');
    }
}
