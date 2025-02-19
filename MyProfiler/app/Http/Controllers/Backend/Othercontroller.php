<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Resume;
use App\Models\Skill;

class OtherController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Lấy danh sách resume và skill của user đang đăng nhập
        $resumes = Resume::where('user_id', $user->id)->latest()->paginate(5);
        $skills = Skill::where('user_id', $user->id)->latest()->paginate(5);

        return view('Backend.User.other', compact('user', 'resumes', 'skills'));
    }

    public function storeResume(Request $request)
    {
        Resume::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'start_year' => $request->start_year,
            'end_year' => $request->end_year,
            'description' => $request->description,
        ]);

        return redirect()->route('other.index');
    }

    public function updateResume(Request $request, Resume $resume)
    {
        $resume->update($request->all());
        return redirect()->route('other.index');
    }

    public function destroyResume(Resume $resume)
    {
        $resume->delete();
        return redirect()->route('other.index');
    }

    public function storeSkill(Request $request)
    {
        Skill::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'percentage' => $request->percentage,
        ]);

        return redirect()->route('other.index');
    }

    public function updateSkill(Request $request, Skill $skill)
    {
        if ($skill->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $skill->update($request->only(['name', 'percentage']));
        return redirect()->route('other.index');
    }

    public function destroySkill(Skill $skill)
    {
        if ($skill->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $skill->delete();
        return redirect()->route('other.index');
    }
}
