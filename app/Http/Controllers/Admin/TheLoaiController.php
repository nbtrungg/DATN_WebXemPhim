<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Theloai;
use Illuminate\Support\Facades\Auth;

class TheLoaiController extends Controller
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
        $listtheloai=Theloai::all();
        return view('admin.the_loai.formtheloai',compact('listtheloai','user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data= $request->all();
        $theloai=new Theloai();
        $theloai->tieude=$data['tieude'];
        $theloai->mota=$data['mota'];
        $theloai->trangthai=$data['trangthai'];
        $theloai->slug=$data['slug'];
        $theloai->save();
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
        $edittheloai=Theloai::find($id);
        $listtheloai=Theloai::all();
        return view('admin.the_loai.formtheloai',compact('listtheloai','edittheloai','user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data= $request->all();
        $theloai= Theloai::find($id);
        $theloai->tieude=$data['tieude'];
        $theloai->mota=$data['mota'];
        $theloai->trangthai=$data['trangthai'];
        $theloai->slug=$data['slug'];
        $theloai->save();
        return redirect()->route('the-loai.create')->with('success','Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Theloai::find($id)->delete();
        return redirect()->back()->with('success','Xóa thành công!');
    }

    public function sapxepbang(Request $request){
        $data=$request->all();
        foreach($data['array_id'] as $key=>$value){
            $theloai=Theloai::find($value);
            $theloai->sapxephang=$key;
            $theloai->save();
        }
    }
}
