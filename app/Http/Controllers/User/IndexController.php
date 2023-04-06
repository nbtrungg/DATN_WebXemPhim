<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Theloai;
use App\Models\Quocgia;
use App\Models\Danhmuc;
use Illuminate\Support\Facades\DB;
class IndexController extends Controller
{
    public function trangchu(Request $request){
        //lấy link khi thanh toán
        $param = $request->all();
        // dd($param);
        // dump($param['vnp_Amount']);
        $danhmuc= Danhmuc::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $theloai= Theloai::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $quocgia= Quocgia::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $user = Auth::user();
        return view('user.layout_user.trangchu',compact('user','danhmuc','theloai','quocgia'));
    }

    public function danhmuc($slug){
        $danhmuc= Danhmuc::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $theloai= Theloai::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $quocgia= Quocgia::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $danhmuc_slug=Danhmuc::where('slug',$slug)->first();
        $user = Auth::user();
        return view('user.layout_user.danhmuc',compact('user','danhmuc','theloai','quocgia','danhmuc_slug'));
    }

    public function theloai($slug){
        $danhmuc= Danhmuc::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $theloai= Theloai::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $quocgia= Quocgia::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $theloai_slug=Theloai::where('slug',$slug)->first();
        $user = Auth::user();
        return view('user.layout_user.theloai',compact('user','danhmuc','theloai','quocgia','theloai_slug'));
    }

    public function quocgia($slug){
        $danhmuc= Danhmuc::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $theloai= Theloai::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $quocgia= Quocgia::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $quocgia_slug=Quocgia::where('slug',$slug)->first();
        $user = Auth::user();
        return view('user.layout_user.quocgia',compact('user','danhmuc','theloai','quocgia','quocgia_slug'));
    }

    public function chitietphim(){
        $danhmuc= Danhmuc::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $theloai= Theloai::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $quocgia= Quocgia::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $user = Auth::user();
        return view('user.layout_user.chitietphim',compact('user','danhmuc','theloai','quocgia'));
    }

    public function xemphim(){
        $danhmuc= Danhmuc::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $theloai= Theloai::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $quocgia= Quocgia::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $user = Auth::user();
        return view('user.layout_user.xemphim',compact('user','danhmuc','theloai','quocgia'));
    }

    public function tapphim(){
        $danhmuc= Danhmuc::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $theloai= Theloai::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $quocgia= Quocgia::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $user = Auth::user();
        return view('user.layout_user.tapphim',compact('user','danhmuc','theloai','quocgia'));
    }

    public function trangchuadmin(){
        $user = Auth::user();
        return view('admin.index_admin',compact('user'));
    }
}
