<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Binhluan;
use App\Models\Danhgia;
use App\Models\Danhmuc;
use App\Models\Lichsuphim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Phim;
use App\Models\Quocgia;
use App\Models\Tapphim;
use App\Models\Theloai;
use App\Models\Yeuthich;
use File;

class PhimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $listphim=Phim::with('danhmuc','theloai','quocgia')->orderBy('id','DESC')->get();
        $danhmuc=Danhmuc::pluck('tieude','id');
        $theloai=Theloai::pluck('tieude','id');
        $quocgia=Quocgia::pluck('tieude','id');
        $path=public_path()."/json_file/";
        if(!is_dir($path)){
            mkdir($path,0777,true);
        }
        File::put($path.'phim.json',json_encode($listphim));
        return view('admin.phim.formphim', compact('listphim','user','danhmuc','theloai','quocgia'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data= $request->all();
        $phim=new Phim();
        $phim->tieude=$data['tieude'];
        $phim->mota=$data['mota'];
        $phim->trangthai=$data['trangthai'];
        $phim->slug=$data['slug'];
        $phim->sotap=$data['sotap'];
        $phim->chatluong=$data['chatluong'];
        $phim->namphim=$data['namphim'];
        $phim->thoiluong=$data['thoiluong'];
        $phim->danhmuc_id=$data['danhmuc_id'];
        $phim->theloai_id=$data['theloai_id'];
        $phim->quocgia_id=$data['quocgia_id'];
        //Thêm ảnh
        $get_image=$request->file('image');
        $path='uploads/anhphim/';
        if($get_image){
            $get_name_image=$get_image->getClientOriginalName();
            $name_image=current(explode('.',$get_name_image));
            $new_image=$name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $phim->hinhanh=$new_image;
        }
        $phim->save();
        return redirect()->back()->with('success','Thêm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();
        $editphim=Phim::find($id);
        $listphim=Phim::with('danhmuc','theloai','quocgia')->orderBy('id','DESC')->get();
        $danhmuc=Danhmuc::pluck('tieude','id');
        $theloai=Theloai::pluck('tieude','id');
        $quocgia=Quocgia::pluck('tieude','id');
        return view('admin.phim.formphim',compact('listphim','editphim','user','danhmuc','theloai','quocgia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data= $request->all();
        $phim=Phim::find($id);
        $phim->tieude=$data['tieude'];
        $phim->mota=$data['mota'];
        $phim->trangthai=$data['trangthai'];
        $phim->slug=$data['slug'];
        $phim->sotap=$data['sotap'];
        $phim->chatluong=$data['chatluong'];
        $phim->namphim=$data['namphim'];
        $phim->thoiluong=$data['thoiluong'];
        $phim->danhmuc_id=$data['danhmuc_id'];
        $phim->theloai_id=$data['theloai_id'];
        $phim->quocgia_id=$data['quocgia_id'];
        //Thêm ảnh
        $get_image=$request->file('image');
        $path='uploads/anhphim/';
        if($get_image){
            if(isset($phim->hinhanh)){
                unlink('uploads/anhphim/'.$phim->hinhanh);
               }
            $get_name_image=$get_image->getClientOriginalName();
            $name_image=current(explode('.',$get_name_image));
            $new_image=$name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $phim->hinhanh=$new_image;
        }
        $phim->save();
        return redirect()->route('phim.create')->with('success','Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $phim = Phim::find($id);
       if(isset($phim->hinhanh)){
        unlink('uploads/anhphim/'.$phim->hinhanh);
        // $phim->delete();
       }
    //    else{
        $tapphim=Tapphim::whereIn('phim_id',[$phim->id])->get();
        // foreach($tapphim as $key=>$item){
        //     if(isset($item->linkphim)){
        //         unlink('uploads/phim/'.$item->linkphim);
        //        }
        // }

            Tapphim::whereIn('phim_id',[$phim->id])->delete();
            Binhluan::whereIn('phim_id',[$phim->id])->delete();
            Yeuthich::whereIn('phim_id',[$phim->id])->delete();
            Danhgia::whereIn('phim_id',[$phim->id])->delete();
            Lichsuphim::whereIn('phim_id',[$phim->id])->delete();
            $phim->delete();
        return redirect()->back()->with('success','Xóa thành công!');
    }
}
