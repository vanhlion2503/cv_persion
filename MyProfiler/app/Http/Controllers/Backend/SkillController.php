<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Skill;

class SkillController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Lấy danh sách kỹ năng của user đang đăng nhập
        $skills = Skill::where('user_id', $user->id)->latest()->paginate(5);

        return view('Backend.User.skills', compact('user', 'skills'));
    }

    public function store(Request $request) 
    {
        Skill::create([
            'user_id' => auth()->id(), // Lấy ID user đang đăng nhập
            'name' => $request->name,
            'percentage' => $request->percentage,
        ]);

        return redirect()->route('skills.index');
    }

    public function update(Request $request, Skill $skill) 
    {
        // Đảm bảo chỉ user sở hữu kỹ năng này mới có thể cập nhật
        if ($skill->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $skill->update($request->only(['name', 'percentage']));
        return redirect()->route('skills.index');
    }

    public function destroy(Skill $skill) 
    {
        // Đảm bảo chỉ user sở hữu mới có thể xóa
        if ($skill->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $skill->delete();
        return redirect()->route('skills.index');
    }
}
