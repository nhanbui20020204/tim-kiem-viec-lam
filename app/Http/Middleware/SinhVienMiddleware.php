<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SinhVienMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $auth = Auth::guard('sinhvien')->check();
        if ($auth) {
            $sinhVien = Auth::guard('sinhvien')->user();
            if ($sinhVien->is_active !== 1) {
                toastr()->error('Tài khoản của bạn đã bị khoá!');

                return redirect('/cong-ty/login');
            }
            return $next($request);
        } else {
            return redirect('/sinh-vien/login');
        }
    }
}
