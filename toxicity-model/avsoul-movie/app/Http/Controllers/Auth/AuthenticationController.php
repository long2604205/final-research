<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    //
    public function Index()
    {
        return view('auth.signin');
    }
    //
    public function redirect ($socialite)
    {
        return Socialite::driver($socialite)->redirect();
    }

    public function callback ($socialite)
    {
        $social = $socialite;

        // dd($socialite_user);

        try {
            $socialite_user =  Socialite::driver($social)->user();

            // dd($socialite_user);

            $user = User::firstOrNew(['email' => $socialite_user->getEmail()]);
            // dd($user);

            if (!$user->exists) {
                // Tạo một người dùng mới nếu chưa tồn tại
                $user->name = $socialite_user->getName();
                $user->socialite_id = $socialite_user->getId();
                $user->avatar = $socialite_user->getAvatar();
                $user->save();
            }

            // Đăng nhập người dùng (cả khi đã tồn tại và khi mới tạo)
            Auth::login($user);

        // Kiểm tra nếu người dùng có vai trò ít nhất là 1
        if ($user->role >= 1) {
            // Chuyển hướng đến trang dashboard
            return redirect()->route('dashboard');
        } else {
            // Nếu không có đủ quyền, chuyển hướng đến trang khác hoặc hiển thị thông báo lỗi
            return redirect()->route('home')->with('error', 'Bạn không có quyền truy cập vào trang dashboard');
        }

        } catch (QueryException $e)
        {
            Log::error('QueryException: ' . $e->getMessage());
        } catch (\Exception $e)
        {
            Log::error('Exception: ' . $e->getMessage());
        }
    }
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
    public function profile()
    {
        return view('client.person.profile');
    }
}