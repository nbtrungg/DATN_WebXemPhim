<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Check_DichVu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if ($user) {
            $dichvu=DB::table('user_goi')->where('user_id',$user->id)->latest('id')->first();
            if((empty($dichvu->end_date)||($dichvu->end_date) < now())){
                return redirect()->route('dangky')->with('error','Bạn cần phải đăng kí gói để xem phim');
            }
        }
        return $next($request);
    }
}
