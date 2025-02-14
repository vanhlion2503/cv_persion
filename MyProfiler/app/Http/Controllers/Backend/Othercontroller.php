<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Resume;

class OtherController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Lấy danh sách resume chỉ của user đang đăng nhập
        $resumes = Resume::where('user_id', $user->id)->latest()->paginate(5);

        return view('Backend.User.other', compact('user', 'resumes'));
    }
    public function store(Request $request) {
        Resume::create([
            'user_id' => auth()->id(), // Lấy ID của user đang đăng nhập
            'name' => $request->name,
            'start_year' => $request->start_year,
            'end_year' => $request->end_year,
            'description' => $request->description,
        ]);
    
        return redirect()->route('other.index');
    }
    

    public function update(Request $request, Resume $resume) {
        $resume->update($request->all());
        return redirect()->route('other.index');
    }

    public function destroy(Resume $resume) {
        $resume->delete();
        return redirect()->route('other.index');
    }
}
