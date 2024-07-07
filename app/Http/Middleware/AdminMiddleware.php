<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        $auth = Auth::guard('admin')->check();
        if ($auth) {
            $admin = Auth::guard('admin')->user();
            if ($admin->is_active == 0) {
                toastr()->error('Tài khoản của bạn đã bị khoá!');
                Auth::guard('admin')->logout();
                return redirect('/admin/login');
            }
            return $next($request);
        } else {
            return redirect('/admin/login');
        }
    }
}
