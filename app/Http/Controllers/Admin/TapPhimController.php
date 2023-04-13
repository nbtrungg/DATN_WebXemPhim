<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Phim;
use App\Models\Tapphim;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TapPhimController extends Controller
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
        $listtapphim=Tapphim::with('phim')->orderBy('id','DESC')->get();
        $listphim=Phim::orderBy('id','DESC')->pluck('tieude','id');
        return view('admin.tap_phim.formtapphim',compact('listtapphim','user','listphim'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data= $request->all();
        $tapphim=new Tapphim();
        $tapphim->phim_id=$data['chonphim'];
        $tapphim->tap=$data['chontap'];
        //Thêm ảnh
        $get_phim=$request->file('uploadphim');
        $path='uploads/phim/';
        if($get_phim){
            $get_name_phim=$get_phim->getClientOriginalName();
            $name_phim=current(explode('.',$get_name_phim));
            $new_phim=$name_phim.rand(0,9999).'.'.$get_phim->getClientOriginalExtension();
            $get_phim->move($path,$new_phim);
            $tapphim->linkphim=$new_phim;
        }
        $tapphim->save();
        return redirect()->back()->with('success','Thêm thành công!');
    }

    public function themtapphim($id){
        $user = Auth::user();
        $listtapphim=Tapphim::with('phim')->where('phim_id',$id)->orderBy('tap','DESC')->get();
        $phim=Phim::find($id);
        // $listphim=Phim::orderBy('id','DESC')->pluck('tieude','id');
        return view('admin.tap_phim.themtapchophim',compact('listtapphim','user','phim'));
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
        // $listtapphim=Tapphim::with('phim')->orderBy('id','DESC')->get();
        $listphim=Phim::orderBy('id','DESC')->pluck('tieude','id');
        $edittapphim=Tapphim::find($id);
        $listtapphim=Tapphim::with('phim')->where('phim_id',$edittapphim->phim_id)->orderBy('tap','DESC')->get();
        return view('admin.tap_phim.themtapchophim',compact('listtapphim','user','listphim','edittapphim'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data= $request->all();
        $tapphim=Tapphim::find($id);
        $tapphim->phim_id=$data['chonphim'];
        $tapphim->tap=$data['chontapupdate'];
        //Thêm ảnh
        $get_phim=$request->file('uploadphim');
        $path='uploads/phim/';
        if($get_phim){
            if(isset($tapphim->linkphim)){
                unlink('uploads/phim/'.$tapphim->linkphim);
            }
            $get_name_phim=$get_phim->getClientOriginalName();
            $name_phim=current(explode('.',$get_name_phim));
            $new_phim=$name_phim.rand(0,9999).'.'.$get_phim->getClientOriginalExtension();
            $get_phim->move($path,$new_phim);
            $tapphim->linkphim=$new_phim;
        }
        $tapphim->save();
        return redirect()->route('them-tap-phim',[$data['chonphim']])->with('success','Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tapphim = Tapphim::find($id);
       if(isset($tapphim->linkphim)){
        unlink('uploads/phim/'.$tapphim->linkphim);
        // $phim->delete();
       }
    //    else{
           $tapphim->delete();
        // }
        return redirect()->back()->with('success','Xóa thành công!');
    }

    public function chontapphim(){
        $id=$_GET['id'];
        $phim=Phim::find($id);
        $output='<option>Chọn Tập</option>';
        for ($i=1; $i<= $phim->sotap ; $i++) {
            $output.='<option value="'.$i.'">'.$i.'</option>';
        }
        echo $output;            
    }
}
