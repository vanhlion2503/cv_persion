<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Social;
use App\Models\User;
class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $links = $user->socials;

        // Kiểm tra nếu người dùng chưa đăng nhập
        if (!$user) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để tiếp tục.');
        }

        return view('welcome', compact('user', 'links'));
    }

    public function showUser($id)
    {
        $user = User::find($id);
        $links = $user->socials;

        // Nếu không tìm thấy user, trả về trang lỗi 404
        if (!$user) {
            abort(404, 'User not found');
        }

        // Truyền thông tin user và links tới view 'user_profile.blade.php'
        return view('welcome', compact('user', 'links'));
    }
}
