<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Route; // Import Route facade
use Illuminate\Support\Facades\View;


class CheckRouteExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra xem route có tồn tại không
        if (!Route::has($request->route()->getName())) {
            // abort(404); // Nếu không tồn tại, chuyển hướng sang trang 404
            return View::make('errors.404'); // Trả về view 404 nếu route không tồn tại
        }
        return $next($request);
    }
}
