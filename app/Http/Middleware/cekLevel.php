<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CekLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed ...$levels
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$levels)
    {
        if (!Auth::check()) {
        // User belum login
            return redirect('/login')->withErrors('Silakan login terlebih dahulu.');
        }

        // samakan huruf kecil semua (case-insensitive)
        $userLevel = strtolower(Auth::user()->level);
        $allowedLevels = array_map('strtolower', $levels);

        if (in_array($userLevel, $allowedLevels)) {
            return $next($request);
        }

        // User sudah login tapi level tidak sesuai
        return redirect('/login')->withErrors('Anda tidak punya akses ke halaman ini.');
    }
}
