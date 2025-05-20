<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    // Đổi mật khẩu & cập nhật hồ sơ
    public function updateProfile(Request $request)
    {
        $request->validate([
            'phone' => 'nullable|string|max:15',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:6|confirmed',
        ]);

        $user = Auth::user();

        // Cập nhật avatar nếu có
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        // Cập nhật số điện thoại
        if ($request->phone) {
            $user->phone = $request->phone;
        }

        // Kiểm tra và cập nhật mật khẩu
        if ($request->current_password && $request->new_password) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng.']);
            }
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return back()->with('success', 'Hồ sơ đã được cập nhật thành công!');
    }

    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $avatarPath = $request->hasFile('avatar') ? $request->file('avatar')->store('avatars', 'public') : null;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'avatar' => $avatarPath,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Đăng ký thành công!');
    }

    public function showLoginForm()
    {
        return view('welcome');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()->withErrors([
                'error' => 'Email hoặc mật khẩu không đúng'
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Đăng nhập thành công!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form')->with('success', 'Đăng xuất thành công!');
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('layouts.profile.edit', compact('user'));
    }

    public function dashboard(Request $request)
    {
        $query = Customer::query();

        if ($request->filled('name')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->name . '%')
                  ->orWhere('phone', 'like', '%' . $request->name . '%');
            });
        }

        // Dùng paginate + giữ lại query string
        $query->orderBy('id', 'desc');
        $customers = $query->paginate(10)->appends($request->all());

        return view('dashboard', compact('customers'));
    }

    // lịch sử đăng nhập đăng xuất
    
}
