<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Binhluan;
use App\Models\Danhgia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Theloai;
use App\Models\Quocgia;
use App\Models\Danhmuc;
use App\Models\Lichsuphim;
use App\Models\Phim;
use App\Models\Tapphim;
use App\Models\Yeuthich;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Raw;
use Illuminate\Support\Carbon;

class IndexController extends Controller
{
    public function trangchu(Request $request){
        $user = Auth::user();
        //Đề xuất phim bằng thuật toán collaborative filtering
        $history = Lichsuphim::where('user_id', $user->id)->get();
        // return dd($history);
        if(!empty($history)){

            $movies = Phim::whereIn('id', $history->pluck('phim_id'))->get();
            
            $recommendations = [];
    
            foreach ($movies as $movie) {
                // Tìm kiếm các người dùng khác cũng đã xem bộ phim này
                $viewers = Lichsuphim::where('phim_id', $movie->id)
                                  ->where('user_id', '<>',$user->id)
                                  ->pluck('user_id');
            
                // Tìm kiếm các bộ phim mà những người dùng này cũng đã xem
                $similarMovies = Lichsuphim::whereIn('user_id', $viewers)
                                        ->where('phim_id', '<>', $movie->id)
                                        ->groupBy('phim_id')
                                        ->selectRaw('phim_id, COUNT(*) as count')
                                        ->orderBy('count','DESC')
                                        ->take(8)
                                        ->get();
            
                // Lấy thông tin về các bộ phim tương tự và thêm vào danh sách đề xuất
                foreach ($similarMovies as $similar) {
                    $similarMovie = Phim::find($similar->phim_id);
            
                    if (!in_array($similarMovie, $recommendations)) {
                        $recommendations[] = $similarMovie;
                    }
                }
            }
            // return dd($recommendations);
            foreach ($recommendations as $key=>$item) {
                $item->tbdanhgia = number_format($item->tbdanhgia(),1);
            }
        }
        // dd($viewers);
        //lấy link khi thanh toán
        $param = $request->all();
        // dd($param);
        // dump($param['vnp_Amount']);
        $danhmuc= Danhmuc::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $theloai= Theloai::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $quocgia= Quocgia::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        // phim top sao
        $phimtopsao = Phim::withAvg('danhgia', 'sao')->orderByDesc('danhgia_avg_sao')->take(8)->get();
        foreach ($phimtopsao as $key=>$item) {
            $item->tbdanhgia = number_format($item->tbdanhgia(),1);
        }
        // dd($phimtopsao);

        // Phim top bình luận
        $phimtopbinhluan = Phim::withCount('Binhluan')->orderByDesc('binhluan_count')->take(8)->get();
        // Phim top yêu thích
        $phimtopyeuthich = Phim::withCount('Yeuthich')->orderByDesc('yeuthich_count')->take(8)->get();

        // dd($phimtopyeuthich);
        return view('user.layout_user.trangchu',compact('user','danhmuc','theloai','quocgia','phimtopsao','phimtopbinhluan','phimtopyeuthich','recommendations'));
    }

    public function danhmuc($slug){
        $danhmuc= Danhmuc::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $theloai= Theloai::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $quocgia= Quocgia::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $danhmuc_slug=Danhmuc::where('slug',$slug)->first();
        $phim=Phim::where('danhmuc_id',$danhmuc_slug->id)->paginate(12);
        foreach ($phim as $key=>$item) {
            $item->tbdanhgia = number_format($item->tbdanhgia(),1);
        }
        $user = Auth::user();
        // dd($phim[0]->danhgia[0]->avg('sao'));
        return view('user.layout_user.danhmuc',compact('user','danhmuc','theloai','quocgia','danhmuc_slug','phim'));
    }

    public function theloai($slug){
        $danhmuc= Danhmuc::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $theloai= Theloai::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $quocgia= Quocgia::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $theloai_slug=Theloai::where('slug',$slug)->first();
        $phim=Phim::where('theloai_id',$theloai_slug->id)->paginate(12);
        foreach ($phim as $key=>$item) {
            $item->tbdanhgia = number_format($item->tbdanhgia(),1);
        }
        $user = Auth::user();
        return view('user.layout_user.theloai',compact('user','danhmuc','theloai','quocgia','theloai_slug','phim'));
    }

    public function quocgia($slug){
        $danhmuc= Danhmuc::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $theloai= Theloai::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $quocgia= Quocgia::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $quocgia_slug=Quocgia::where('slug',$slug)->first();
        $phim=Phim::where('quocgia_id',$quocgia_slug->id)->paginate(12);
        foreach ($phim as $key=>$item) {
            $item->tbdanhgia = number_format($item->tbdanhgia(),1);
        }
        $user = Auth::user();
        return view('user.layout_user.quocgia',compact('user','danhmuc','theloai','quocgia','quocgia_slug','phim'));
    }

    public function chitietphim($slug){
        $user = Auth::user();
        $danhmuc= Danhmuc::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $theloai= Theloai::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $quocgia= Quocgia::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $chitietphim= Phim::with('danhmuc','theloai','quocgia')->where('slug',$slug)->where('trangthai',1)->first();
        $tapphim_1=Tapphim::with('phim')->where('phim_id',$chitietphim->id)->orderBy('tap','ASC')->take(1)->first();
        $phimlienquan=Phim::with('danhmuc','theloai','quocgia')->where('danhmuc_id',$chitietphim->danhmuc->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->get();
        $binhluan=Binhluan::with('user')->where('phim_id',$chitietphim->id)->orderBy('id','DESC')->paginate(5);
        $tongbinhluan=Binhluan::with('user')->where('phim_id',$chitietphim->id)->orderBy('id','DESC')->count();
        foreach ($phimlienquan as $key=>$item) {
            $item->tbdanhgia = number_format($item->tbdanhgia(),1);
        }
        // Đánh giá phim
        $rating=Danhgia::where('phim_id',$chitietphim->id)->avg('sao');
        $rating=number_format($rating,1);
        $luotdanhgia=Danhgia::where('phim_id',$chitietphim->id)->count();
        //kiểm tra yêu thích
        $yeuthich_check=Yeuthich::where('phim_id',$chitietphim->id)->where('user_id',$user->id)->count();
        return view('user.layout_user.chitietphim',compact('user','danhmuc','theloai','quocgia','chitietphim','phimlienquan','tapphim_1','binhluan','tongbinhluan','rating','luotdanhgia','yeuthich_check'));
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
        $lichsuphim_check=Lichsuphim::where('user_id',$user->id)->where('phim_id',$chitietphim->id)->count();
        if($lichsuphim_check>0){
            Lichsuphim::where('user_id',$user->id)->where('phim_id',$chitietphim->id)->delete();
            $lichsuphim= new Lichsuphim();
            $lichsuphim->user_id=$user->id;
            $lichsuphim->phim_id=$chitietphim->id;
            $lichsuphim->save();
        }else{

            $lichsuphim= new Lichsuphim();
            $lichsuphim->user_id=$user->id;
            $lichsuphim->phim_id=$chitietphim->id;
            $lichsuphim->save();
        }
        // dd($chitietphim);
        return view('user.layout_user.xemphim',compact('user','danhmuc','theloai','quocgia','chitietphim','phimlienquan','tapphim','sotapphim'));
    }

    public function tapphim(){
        $danhmuc= Danhmuc::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $theloai= Theloai::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $quocgia= Quocgia::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $user = Auth::user();
        return view('user.layout_user.tapphim',compact('user','danhmuc','theloai','quocgia'));
    }

    public function danhsachyeuthich(){
        $user = Auth::user();
        $danhmuc= Danhmuc::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $theloai= Theloai::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $quocgia= Quocgia::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        // $user = User::find(1);
        $phim = $user->phimyeuthich()->orderBy('yeuthiches.id','DESC')->paginate(12);
        // $phim=Yeuthich::with('phim')->where('user_id',$user->id)->paginate(12);
        foreach ($phim as $key=>$item) {
            $item->tbdanhgia = number_format($item->tbdanhgia(),1);
        }
        // dd($phim[1]->tbdanhgia());
        return view('user.layout_user.phimyeuthich',compact('user','danhmuc','theloai','quocgia','phim'));
    }

    public function lichsuxemphim(){
        $user = Auth::user();
        $danhmuc= Danhmuc::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $theloai= Theloai::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        $quocgia= Quocgia::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
        // $user = User::find(1);
        $phim = $user->phimyeuthich()->orderBy('yeuthiches.id','DESC')->paginate(12);
        // $phim=Yeuthich::with('phim')->where('user_id',$user->id)->paginate(12);
        foreach ($phim as $key=>$item) {
            $item->tbdanhgia = number_format($item->tbdanhgia(),1);
        }
        // dd($phim[1]->tbdanhgia());
        return view('user.layout_user.lichsuphim',compact('user','danhmuc','theloai','quocgia','phim'));
    }

    public function trangchuadmin(){
        $user = Auth::user();
        return view('admin.index_admin',compact('user'));
    }

    //bình luận
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

    //đánh giá sao
    public function danhgiasao(Request $request){
        $data=$request->all();
        $user = Auth::user();
        $rating_count=Danhgia::where('phim_id',$data['movie_id'])->where('user_id',$user->id)->count();
        if($rating_count>0){
            echo 'exist';
        }
        else{
            $rating=new Danhgia();
            $rating->phim_id=$data['movie_id'];
            $rating->sao=$data['index'];
            $rating->user_id=$user->id;
            $rating->save();
            echo 'done';
        }
    }
    //yêu thích
    public function yeuthich(Request $request){
        $data= $request->all();
        $user = Auth::user();
        $yeuthich=new Yeuthich();
        $yeuthich->user_id=$user->id;
        $yeuthich->phim_id=$data['phim_id'];;
        $yeuthich->save();
        return response()->json([
            'success' => true,
        ]);
    }
    // hủy thích
    public function huyyeuthich(Request $request){
        $data= $request->all();
        $user = Auth::user();
        Yeuthich::where('phim_id',$data['phim_id'])->where('user_id',$user->id)->delete();
        return response()->json([
            'success' => true,
        ]);
    }

    //Tìm kiếm phim
    public function timkiem(){
        if(isset($_GET['search'])){
            $search=$_GET['search'];
            $danhmuc= Danhmuc::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
            $theloai= Theloai::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
            $quocgia= Quocgia::orderBy('sapxephang', 'ASC')->where('trangthai',1)->get();
            $phim=Phim::where('tieude','LIKE','%'.$search.'%')->paginate(12);
            foreach ($phim as $key=>$item) {
                $item->tbdanhgia = number_format($item->tbdanhgia(),1);
            }
            $user = Auth::user();
            // dd($phim[0]->danhgia[0]->avg('sao'));
            return view('user.layout_user.timkiem',compact('user','danhmuc','theloai','quocgia','search','phim'));
        }else{
            return redirect()->to('/trang-chu');
        }
    }
}
