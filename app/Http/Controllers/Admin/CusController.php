<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CusController extends Controller
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
        $listuser=User::orderBy('id','DESC')->get();
        return view('admin.customer.formcus',compact('listuser','user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data= $request->all();
        $danhmuc=new Danhmuc();
        $danhmuc->tieude=$data['tieude'];
        $danhmuc->mota=$data['mota'];
        $danhmuc->trangthai=$data['trangthai'];
        $danhmuc->slug=$data['slug'];
        $danhmuc->save();
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
        $editdanhmuc=Danhmuc::find($id);
        $listdanhmuc=Danhmuc::orderBy('sapxephang','ASC')->get();
        return view('admin.danh_muc.formdanhmuc',compact('listdanhmuc','editdanhmuc','user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data= $request->all();
        $danhmuc= Danhmuc::find($id);
        $danhmuc->tieude=$data['tieude'];
        $danhmuc->mota=$data['mota'];
        $danhmuc->trangthai=$data['trangthai'];
        $danhmuc->slug=$data['slug'];
        $danhmuc->save();
        return redirect()->route('danh-muc.create')->with('success','Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Danhmuc::find($id)->delete();
        return redirect()->back()->with('success','Xóa thành công!');
    }

    //sắp xếp bảng
    //[1,2,3,4,6]
    //=>[0=>1]
    //=>[1=>2]
    //=>[2=>3]
    //=>[3=>4]
    //=>[4=>6]
    public function sapxepbang(Request $request){
        $data=$request->all();
        foreach($data['array_id'] as $key=>$value){
            $danhmuc=Danhmuc::find($value);
            $danhmuc->sapxephang=$key;
            $danhmuc->save();
        }
    }
}
