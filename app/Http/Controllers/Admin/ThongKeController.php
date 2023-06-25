<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Binhluan;
use App\Models\Danhgia;
use App\Models\Goidichvu;
use App\Models\Phim;
use App\Models\Tapphim;
use App\Models\User;
use App\Models\Yeuthich;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ThongKeController extends Controller
{
    public function thongke(){
        
        $user = Auth::user();
        $tonguser=User::all()->count();
        $tongphim=Phim::all()->count();
        $tongtapphim=Tapphim::all()->count();
        $goi=Goidichvu::all();
        $tonggoi=$goi->count();
        $goi1=DB::table('user_goi')->where('goi_id',9)->get();
        $goi2=DB::table('user_goi')->where('goi_id',2)->get();
        $goi3=DB::table('user_goi')->where('goi_id',10)->get();
        $goi4=DB::table('user_goi')->where('goi_id',1)->get();
        // dd($goi4->count());
        $tongyeuthich=Yeuthich::all()->count();
        $tongdanhgia=Danhgia::all()->count();
        $tongbinhluan=Binhluan::all()->count();
        return view('admin.thongke',compact('user','tonguser','tongphim','tongtapphim','tonggoi','goi1','goi2','goi3','goi4','tongyeuthich','tongdanhgia','tongbinhluan'));
    }
    public function postthongke(Request $request){
        $ngayBatDau = $request->input('ngaybatdau');
        $ngayKetThuc = $request->input('ngayketthuc');
        // dd($ngayBatDau);
        $user = Auth::user();
        $tonguser=User::all()->count();
        $tongphim=Phim::all()->count();
        $tongtapphim=Tapphim::all()->count();
        $goi=Goidichvu::all();
        $tonggoi=$goi->count();
        $goi1=DB::table('user_goi')->where('goi_id',9)->whereBetween('start_date', [$ngayBatDau, $ngayKetThuc])->get();
        $goi2=DB::table('user_goi')->where('goi_id',2)->whereBetween('start_date', [$ngayBatDau, $ngayKetThuc])->get();
        $goi3=DB::table('user_goi')->where('goi_id',10)->whereBetween('start_date', [$ngayBatDau, $ngayKetThuc])->get();
        $goi4=DB::table('user_goi')->where('goi_id',1)->whereBetween('start_date', [$ngayBatDau, $ngayKetThuc])->get();
        // dd($goi4->count());
        $tongyeuthich=Yeuthich::all()->count();
        $tongdanhgia=Danhgia::all()->count();
        $tongbinhluan=Binhluan::all()->count();
        return view('admin.thongke',compact('user','tonguser','tongphim','tongtapphim','tonggoi','goi1','goi2','goi3','goi4','tongyeuthich','tongdanhgia','tongbinhluan','ngayBatDau','ngayKetThuc'));
    }
}
