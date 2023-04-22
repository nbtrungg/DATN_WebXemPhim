<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Goidichvu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoiDichVuController extends Controller
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
        $listgoidichvu=Goidichvu::orderBy('sapxephang','ASC')->get();
        return view('admin.goi_dich_vu.formgoidichvu',compact('listgoidichvu','user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data= $request->all();
        $goidichvu=new Goidichvu();
        $goidichvu->name=$data['tieude'];
        $goidichvu->mota=$data['mota'];
        $goidichvu->gia=$data['gia'];
        $goidichvu->thoigian=$data['thoigian'];
        $goidichvu->trangthai=$data['trangthai'];
        $goidichvu->save();
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
        $editgoidichvu=Goidichvu::find($id);
        $listgoidichvu=Goidichvu::orderBy('sapxephang','ASC')->get();
        return view('admin.goi_dich_vu.formgoidichvu',compact('listgoidichvu','editgoidichvu','user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data= $request->all();
        $goidichvu= Goidichvu::find($id);
        $goidichvu->name=$data['tieude'];
        $goidichvu->mota=$data['mota'];
        $goidichvu->gia=$data['gia'];
        $goidichvu->thoigian=$data['thoigian'];
        $goidichvu->trangthai=$data['trangthai'];
        $goidichvu->save();
        return redirect()->route('goi-dich-vu.create')->with('success','Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Goidichvu::find($id)->delete();
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
            $goidichvu=Goidichvu::find($value);
            $goidichvu->sapxephang=$key;
            $goidichvu->save();
        }
    }
}
