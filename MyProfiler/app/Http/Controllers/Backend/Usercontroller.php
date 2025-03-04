<?php

namespace App\Http\Controllers\Backend;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\Rule; 

class Usercontroller extends Controller
{
    public function __construct(){
    }
    public function index(){
        $user = Auth::user();
        return view('Backend.User.user', compact('user'));
    }
    public function update(Request $request)
    {
        
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
            'congviec' => 'nullable|string|max:1000',
            'gioithieu' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ]);
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $uploadedFile = $request->file('image');
            
            // Upload ảnh lên Cloudinary với try-catch
            $uploadResponse = Cloudinary::upload(
                $uploadedFile->getRealPath(),
                ['folder' => 'profile_images']
            );
            
            // Kiểm tra URL trả về
            if (!$uploadResponse->getSecurePath()) {
                throw new \Exception('Cloudinary không trả về URL hợp lệ.');
            }
            
            $user->image = $uploadResponse->getSecurePath();
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->birthday = $request->birthday;
        $user->congviec = $request->congviec;
        $user->gioithieu = $request->gioithieu;
        $user->save();
        return redirect()->route('user.index')->with('success', 'Cập nhật thành công!');
    }
}
