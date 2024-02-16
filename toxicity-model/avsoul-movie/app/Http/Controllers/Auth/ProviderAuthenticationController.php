<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProviderAuthenticationController extends Controller
{
    //
    public function Index()
    {
        return view('auth.login');
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

            // Chuyển hướng đến trang home
            return redirect()->route('home');

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

        return redirect()->route('signin');
    }
}