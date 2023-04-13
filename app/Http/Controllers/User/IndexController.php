<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Binhluan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Theloai;
use App\Models\Quocgia;
use App\Models\Danhmuc;
use App\Models\Phim;
use App\Models\Tapphim;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Raw;
use Illuminate\Support\Carbon;

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
        $phim=Phim::where('danhmuc_id',$danhmuc_slug->id)->paginate(12);
        $user = Auth::user();
        return view('user.layout_user.danhmuc',compact('user','danhmuc','theloai','quocgia','danhmuc_slug','phim'));
    }

    public function theloai($slug){
        $danhmuc= Danhmuc::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $theloai= Theloai::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $quocgia= Quocgia::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $theloai_slug=Theloai::where('slug',$slug)->first();
        $phim=Phim::where('theloai_id',$theloai_slug->id)->paginate(12);

        $user = Auth::user();
        return view('user.layout_user.theloai',compact('user','danhmuc','theloai','quocgia','theloai_slug','phim'));
    }

    public function quocgia($slug){
        $danhmuc= Danhmuc::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $theloai= Theloai::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $quocgia= Quocgia::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $quocgia_slug=Quocgia::where('slug',$slug)->first();
        $phim=Phim::where('quocgia_id',$quocgia_slug->id)->paginate(12);

        $user = Auth::user();
        return view('user.layout_user.quocgia',compact('user','danhmuc','theloai','quocgia','quocgia_slug','phim'));
    }

    public function chitietphim($slug){
        $danhmuc= Danhmuc::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $theloai= Theloai::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $quocgia= Quocgia::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $chitietphim= Phim::with('danhmuc','theloai','quocgia')->where('slug',$slug)->where('trangthai',1)->first();
        $tapphim_1=Tapphim::with('phim')->where('phim_id',$chitietphim->id)->orderBy('tap','ASC')->take(1)->first();
        $phimlienquan=Phim::with('danhmuc','theloai','quocgia')->where('danhmuc_id',$chitietphim->danhmuc->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->get();
        $binhluan=Binhluan::with('user')->where('phim_id',$chitietphim->id)->orderBy('id','DESC')->paginate(5);
        $tongbinhluan=Binhluan::with('user')->where('phim_id',$chitietphim->id)->orderBy('id','DESC')->count();
        $user = Auth::user();
        return view('user.layout_user.chitietphim',compact('user','danhmuc','theloai','quocgia','chitietphim','phimlienquan','tapphim_1','binhluan','tongbinhluan'));
    }

    public function xemphim($slug,$tap){
        $danhmuc= Danhmuc::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $theloai= Theloai::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $quocgia= Quocgia::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $chitietphim= Phim::with('danhmuc','theloai','quocgia','tapphim')->where('slug',$slug)->where('trangthai',1)->first();
        if(isset($tap)){
            $sotapphim=$tap;
            $sotapphim=substr($tap,4);
            $tapphim=Tapphim::where('phim_id',$chitietphim->id)->where('tap',$sotapphim)->first();
        }
        else{
            $sotapphim=1;
            $tapphim=Tapphim::where('phim_id',$chitietphim->id)->where('tap',$sotapphim)->first();
        }
        $phimlienquan=Phim::with('danhmuc','theloai','quocgia')->where('danhmuc_id',$chitietphim->danhmuc->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->get();
        $user = Auth::user();
        return view('user.layout_user.xemphim',compact('user','danhmuc','theloai','quocgia','chitietphim','phimlienquan','tapphim','sotapphim'));
        // dd($chitietphim);
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

    public function binhluan(Request $request){
        // $data= $request->all();
        $binhluan=new Binhluan();
        $binhluan->user_id=$request->input('user_id');
        $binhluan->phim_id=$request->input('phim_id');;
        $binhluan->noidung=$request->input('content');;
        $binhluan->save();
        $dt = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        return response()->json([
            'success' => true,
            'message' => 'Comment added successfully.',
            'ngay'=> $dt
        ]);
    }
}
