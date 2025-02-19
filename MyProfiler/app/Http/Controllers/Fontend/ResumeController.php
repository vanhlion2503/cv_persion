<?php

namespace App\Http\Controllers\Fontend;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Social;
use App\Models\User;
use App\Models\Resume;
use App\Models\Skill;
class ResumeController extends Controller
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
        $links = $user->socials;
        $resumes = $user->resumes()->orderBy('start_year', 'desc')->get();
        $skills = $user->skills()->get();


        return view('Fontend.Resume.resume', compact('user', 'links','resumes','skills'));
    }
}
