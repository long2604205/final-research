<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\View;


class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $userRole = auth()->user()->role;

        // Kiểm tra xem vai trò của người dùng có đáp ứng yêu cầu hay không
        if (!in_array($userRole, $roles)) {
            // return redirect('/no-access');
            return response()->view('errors.403', [], 403); // Trả về view 403 nếu không có quyền truy cập

        }
        return $next($request);
    }
}