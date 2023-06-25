<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $user=new User();
        $user->name=$data['ten'];
        $user->email=$data['email'];
        $user->password= bcrypt($data['password']);
        $user->save();
        // $user = new User();
        // $user->name = $request->input('name');
        // $user->email = $request->input('email_dk');
        // $user->password = bcrypt($request->input('pass_dk'));
        // $user->save();
        // $user->user_theloai()->attach($request->input('theloai'));
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
        $editcus=User::find($id);
        $user_goi=DB::table('user_goi')->where('user_id',$editcus->id)->orderBy('id','DESC')->first();
        $listuser=User::orderBy('id','DESC')->get();
        return view('admin.customer.formcus',compact('listuser','editcus','user','user_goi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $data= $request->all();
        // $danhmuc= Danhmuc::find($id);
        // $danhmuc->tieude=$data['tieude'];
        // $danhmuc->mota=$data['mota'];
        // $danhmuc->trangthai=$data['trangthai'];
        // $danhmuc->slug=$data['slug'];
        // $danhmuc->save();
        $data= $request->all();
        $user=User::find($id);
        $user->name=$data['ten'];
        $user->email=$data['email'];
        // $user->password= bcrypt($data['password']);
        if(!empty($data['date'])){
        DB::table('user_goi')->where('user_id',$id)->update(['end_date'=>$data['date']]);
        }
        $user->save();
        return redirect()->route('nguoi-dung.create')->with('success','Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();
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
