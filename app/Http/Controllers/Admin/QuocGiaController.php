<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quocgia;
use Illuminate\Support\Facades\Auth;

class QuocGiaController extends Controller
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
        $listquocgia=Quocgia::orderBy('sapxephang','ASC')->get();
        return view('admin.quoc_gia.formquocgia',compact('listquocgia','user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data= $request->all();
        $quocgia=new Quocgia();
        $quocgia->tieude=$data['tieude'];
        $quocgia->mota=$data['mota'];
        $quocgia->trangthai=$data['trangthai'];
        $quocgia->slug=$data['slug'];
        $quocgia->save();
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
        $editquocgia=Quocgia::find($id);
        $listquocgia=Quocgia::orderBy('sapxephang','ASC')->get();
        return view('admin.quoc_gia.formquocgia',compact('listquocgia','editquocgia','user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data= $request->all();
        $quocgia= Quocgia::find($id);
        $quocgia->tieude=$data['tieude'];
        $quocgia->mota=$data['mota'];
        $quocgia->trangthai=$data['trangthai'];
        $quocgia->slug=$data['slug'];
        $quocgia->save();
        return redirect()->route('quoc-gia.create')->with('success','Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Quocgia::find($id)->delete();
        return redirect()->back()->with('success','Xóa thành công!');
    }

    public function sapxepbang(Request $request){
        $data=$request->all();
        foreach($data['array_id'] as $key=>$value){
            $quocgia=Quocgia::find($value);
            $quocgia->sapxephang=$key;
            $quocgia->save();
        }
    }
}
