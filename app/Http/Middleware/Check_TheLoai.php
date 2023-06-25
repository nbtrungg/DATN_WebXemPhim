<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Check_TheLoai
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
            $theloai=DB::table('user_theloai')->where('user_id',$user->id)->get();
            if($theloai->count()==0){
                return redirect()->route('thanhcong')->with('error','Bạn cần phải chọn thể loại phim ưa thích');
            }
        }
        return $next($request);
    }
}
