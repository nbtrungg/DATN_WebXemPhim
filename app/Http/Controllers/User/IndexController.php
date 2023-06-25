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
use App\Models\Phim_Theloai;
use App\Models\Tapphim;
use App\Models\Tientrinhxemphim;
use App\Models\User_Theloai;
use App\Models\Yeuthich;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Raw;
use Illuminate\Support\Carbon;
use Google\Cloud\Vision\VisionClient;
use Intervention\Image\Facades\Image;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use GuzzleHttp\Client;

class IndexController extends Controller
{
    public function trangchu(Request $request)
    {
        $user = Auth::user();
        //Đề xuất phim bằng thuật toán collaborative filtering đánh giá

        // Lấy id của người dùng hiện tại
        $userId = Auth::id();

        // Tìm tất cả các bộ phim đã được đánh giá bởi người dùng khác
        $otherUsers = DB::table('danhgias')
            ->where('user_id', '<>', $userId)
            ->pluck('user_id')
            ->unique();

        // Tính tổng điểm đánh giá và số lượt đánh giá cho tất cả các bộ phim đã được đánh giá bởi người dùng khác
        $sums = DB::table('danhgias')
            ->whereIn('user_id', $otherUsers)
            ->groupBy('phim_id')
            ->selectRaw('phim_id, SUM(sao) as sum, COUNT(*) as count')
            ->get();

        // Tạo một mảng chứa độ tương đồng giữa người dùng hiện tại và từng người dùng khác
        $similarities = [];

        foreach ($otherUsers as $otherUser) {
            // Tìm các bộ phim đã được đánh giá bởi cả người dùng hiện tại và người dùng khác
            $sharedMovies = DB::table('danhgias')
                ->whereIn('user_id', [$userId, $otherUser])
                ->groupBy('phim_id')
                ->havingRaw('COUNT(*) = 2')
                ->pluck('phim_id');

            // Tính tổng điểm đánh giá của các bộ phim đã được đánh giá bởi cả người dùng hiện tại và người dùng khác
            $sum1 = DB::table('danhgias')
                ->where('user_id', $userId)
                ->whereIn('phim_id', $sharedMovies)
                ->sum('sao');

            $sum2 = DB::table('danhgias')
                ->where('user_id', $otherUser)
                ->whereIn('phim_id', $sharedMovies)
                ->sum('sao');

            // Tính độ tương đồng dựa trên tổng điểm đánh giá của các bộ phim chung
            $similarity = $sum1 * $sum2 > 0 ? ($sum1 * $sum2) / sqrt(pow($sum1, 2) + pow($sum2, 2)) : 0;

            // Lưu độ tương đồng vào mảng
            $similarities[$otherUser] = $similarity;
        }

        // Sắp xếp mảng độ tương đồng theo thứ tự giảm dần
        arsort($similarities);

        // Tạo một mảng chứa các bộ phim được đề xuất
        $recommendations = [];

        // Lặp qua các người dùng có độ tương đồng cao nhất với người dùng hiện tại để tìm các bộ phim họ đã đánh giá
        foreach ($similarities as $otherUser => $similarity) {
            // Bỏ qua các người dùng có độ tương đồng bằng 0
            if ($similarity == 0) {
                continue;
            }

            // Tìm các bộ phim được được đánh giá bởi người dùng này và chưa được người dùng hiện tại đánh giá
            $unratedMovies = DB::table('danhgias')
                ->where('user_id', $otherUser)
                ->whereNotIn('phim_id', function ($query) use ($userId) {
                    $query->select('phim_id')
                        ->from('danhgias')
                        ->where('user_id', $userId);
                })
                ->pluck('phim_id');
            // Lặp qua các bộ phim chưa được người dùng hiện tại đánh giá và tính điểm đề xuất dựa trên độ tương đồng và điểm đánh giá của người dùng khác
            foreach ($unratedMovies as $movie) {
                $weightedSum = 0;
                $similaritySum = 0;

                foreach ($otherUsers as $u) {
                    // Kiểm tra xem người dùng này đã đánh giá bộ phim này chưa
                    $rating = DB::table('danhgias')
                        ->where('user_id', $u)
                        ->where('phim_id', $movie)
                        ->value('sao');

                    // Nếu người dùng đã đánh giá bộ phim này, tính điểm đề xuất dựa trên độ tương đồng và điểm đánh giá của người dùng này
                    if ($rating !== null) {
                        $weightedSum += $similarities[$u] * $rating;
                        $similaritySum += $similarities[$u];
                    }
                }

                // Nếu có ít nhất một người dùng khác đã đánh giá bộ phim này, tính điểm đề xuất và lưu vào mảng
                if ($similaritySum > 0) {
                    $recommendations[$movie] = $weightedSum / $similaritySum;
                }
            }
        }
        // Sắp xếp mảng đề xuất theo thứ tự giảm dần của điểm đề xuất
        arsort($recommendations);

        // Lấy ra 10 bộ phim có điểm đề xuất cao nhất và trả về cho người dùng
        $phimdexuat_id = array_slice(array_keys($recommendations), 0, 10);
        $phimdexuat_sao=[];
        if(!empty($phimdexuat_id)){

            $phimdexuat_sao = Phim::whereIn('id', $phimdexuat_id)->orderByRaw("FIELD(id, " . implode(',', $phimdexuat_id) . ")")
                ->whereNotIn('id', function ($query) {
                    $query->select('phim_id')
                        ->from('lichsuphims')
                        ->where('user_id', Auth::user()->id);
                })
                ->get();
    
            foreach ($phimdexuat_sao as $key => $item) {
                $item->tbdanhgia = number_format($item->tbdanhgia(), 1);
            }
        }
        // return dd($phimdexuat_sao);

        //Đề xuất phim bằng thuật toán collaborative filtering lịch sử xem phim
        $history = Lichsuphim::where('user_id', $user->id)->get();
        // return dd($history);
        if (!empty($history)) {

            $movies = Phim::whereIn('id', $history->pluck('phim_id'))->get();

            $recommendations = [];

            foreach ($movies as $movie) {
                // Tìm kiếm các người dùng khác cũng đã xem bộ phim này
                $viewers = Lichsuphim::where('phim_id', $movie->id)
                    ->where('user_id', '<>', $user->id)
                    ->pluck('user_id');

                // Tìm kiếm các bộ phim mà những người dùng này cũng đã xem
                $similarMovies = Lichsuphim::whereIn('user_id', $viewers)
                    ->where('phim_id', '<>', $movie->id)
                    ->groupBy('phim_id')
                    ->selectRaw('phim_id, COUNT(*) as count')
                    ->orderBy('count', 'DESC')
                    ->take(8)
                    ->get();

                // Lấy thông tin về các bộ phim tương tự và thêm vào danh sách đề xuất
                foreach ($similarMovies as $similar) {
                    $similarMovie = Phim::find($similar->phim_id);

                    if (!in_array($similarMovie, $recommendations)&&!$history->contains('phim_id', $similarMovie->id)) {
                        $recommendations[] = $similarMovie;
                    }
                }
            }
            // return dd($recommendations);
            foreach ($recommendations as $key => $item) {
                $item->tbdanhgia = number_format($item->tbdanhgia(), 1);
            }
        }
        //Đề xuất phim dựa trên sở thích người dùng
        $user_theloai = User_Theloai::where('user_id', $user->id)->get(); // các ID của các thể loại viễn tưởng, kinh dị, hoạt hình
        $theloai_ids = [];
        foreach ($user_theloai as $key => $item) {
            $theloai_ids[] = $item->theloai_id;
        }
        // return dd($theloai_ids);
        $phim_user_theloai = Phim::whereIn('id', function ($query) use ($theloai_ids) {
            $query->select('phim_id')
                ->from('phim_theloai')
                ->whereIn('theloai_id', $theloai_ids)
                ->groupBy('phim_id')
                ->havingRaw('COUNT(phim_id) >= ?', [2]);
        })
            ->whereNotIn('id', function ($query) {
                $query->select('phim_id')
                    ->from('lichsuphims')
                    ->where('user_id', Auth::user()->id);
            })
            // ->withCount('phim_id')
            // ->orderByDesc('phim_id_count')
            ->withCount(['phim_theloai' => function ($query) use ($theloai_ids) {
                $query->whereIn('theloai_id', $theloai_ids);
            }])
            ->orderByDesc('phim_theloai_count')
            ->get();
        foreach ($phim_user_theloai as $key => $item) {
            $item->tbdanhgia = number_format($item->tbdanhgia(), 1);
        }
        // return dd($movies);
        //lấy link khi thanh toán
        // $param = $request->all();
        // return dd($param);
        // dump($param['vnp_Amount']);
        $danhmuc = Danhmuc::orderBy('sapxephang', 'ASC')->where('trangthai', 1)->get();
        $theloai = Theloai::orderBy('sapxephang', 'ASC')->where('trangthai', 1)->get();
        $quocgia = Quocgia::orderBy('sapxephang', 'ASC')->where('trangthai', 1)->get();
        // phim top sao
        $phimtopsao = Phim::withAvg('danhgia', 'sao')->orderByDesc('danhgia_avg_sao')->take(8)->get();
        foreach ($phimtopsao as $key => $item) {
            $item->tbdanhgia = number_format($item->tbdanhgia(), 1);
        }
        // dd($phimtopsao);

        // Phim top bình luận
        $phimtopbinhluan = Phim::withCount('Binhluan')->orderByDesc('binhluan_count')->take(8)->get();
        // Phim top yêu thích
        $phimtopyeuthich = Phim::withCount('Yeuthich')->orderByDesc('yeuthich_count')->take(8)->get();

        // return dd($request);
        return view('user.layout_user.trangchu', compact('user', 'danhmuc', 'theloai', 'quocgia', 'phimtopsao', 'phimtopbinhluan', 'phimtopyeuthich', 'recommendations', 'phim_user_theloai', 'phimdexuat_sao'));
    }

    public function danhmuc($slug)
    {
        $danhmuc = Danhmuc::orderBy('sapxephang', 'ASC')->where('trangthai', 1)->get();
        $theloai = Theloai::orderBy('sapxephang', 'ASC')->where('trangthai', 1)->get();
        $quocgia = Quocgia::orderBy('sapxephang', 'ASC')->where('trangthai', 1)->get();
        $danhmuc_slug = Danhmuc::where('slug', $slug)->first();
        $phim = Phim::where('danhmuc_id', $danhmuc_slug->id)->orderBy('id','DESC')->paginate(12);
        foreach ($phim as $key => $item) {
            $item->tbdanhgia = number_format($item->tbdanhgia(), 1);
        }
        $user = Auth::user();
        // dd($phim[0]->danhgia[0]->avg('sao'));
        return view('user.layout_user.danhmuc', compact('user', 'danhmuc', 'theloai', 'quocgia', 'danhmuc_slug', 'phim'));
    }

    public function theloai($slug)
    {
        $danhmuc = Danhmuc::orderBy('sapxephang', 'ASC')->where('trangthai', 1)->get();
        $theloai = Theloai::orderBy('sapxephang', 'ASC')->where('trangthai', 1)->get();
        $quocgia = Quocgia::orderBy('sapxephang', 'ASC')->where('trangthai', 1)->get();
        $theloai_slug = Theloai::where('slug', $slug)->first();
        //Phim nhieu thể loại
        $phim_theloai = Phim_Theloai::where('theloai_id', $theloai_slug->id)->get();
        $nhieu_theloai = [];
        foreach ($phim_theloai as $key => $item) {
            $nhieu_theloai[] = $item->phim_id;
        }
        // return dd($nhieu_theloai);
        $phim = Phim::whereIn('id', $nhieu_theloai)->orderBy('id','DESC')->paginate(12);
        foreach ($phim as $key => $item) {
            $item->tbdanhgia = number_format($item->tbdanhgia(), 1);
        }
        $user = Auth::user();
        return view('user.layout_user.theloai', compact('user', 'danhmuc', 'theloai', 'quocgia', 'theloai_slug', 'phim'));
    }

    public function quocgia($slug)
    {
        $danhmuc = Danhmuc::orderBy('sapxephang', 'ASC')->where('trangthai', 1)->get();
        $theloai = Theloai::orderBy('sapxephang', 'ASC')->where('trangthai', 1)->get();
        $quocgia = Quocgia::orderBy('sapxephang', 'ASC')->where('trangthai', 1)->get();
        $quocgia_slug = Quocgia::where('slug', $slug)->first();
        $phim = Phim::where('quocgia_id', $quocgia_slug->id)->orderBy('id','DESC')->paginate(12);
        foreach ($phim as $key => $item) {
            $item->tbdanhgia = number_format($item->tbdanhgia(), 1);
        }
        $user = Auth::user();
        return view('user.layout_user.quocgia', compact('user', 'danhmuc', 'theloai', 'quocgia', 'quocgia_slug', 'phim'));
    }

    public function chitietphim($slug)
    {
        $user = Auth::user();
        $danhmuc = Danhmuc::orderBy('sapxephang', 'ASC')->where('trangthai', 1)->get();
        $theloai = Theloai::orderBy('sapxephang', 'ASC')->where('trangthai', 1)->get();
        $quocgia = Quocgia::orderBy('sapxephang', 'ASC')->where('trangthai', 1)->get();
        $chitietphim = Phim::with('danhmuc', 'phim_theloai', 'quocgia')->where('slug', $slug)->where('trangthai', 1)->first();
        $tapphim_1 = Tapphim::with('phim')->where('phim_id', $chitietphim->id)->orderBy('tap', 'ASC')->take(1)->first();
        $phimlienquan = Phim::with('danhmuc', 'theloai', 'quocgia')->where('danhmuc_id', $chitietphim->danhmuc->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug', [$slug])->get();
        $binhluan = Binhluan::with('user')->where('phim_id', $chitietphim->id)->orderBy('id', 'DESC')->paginate(5);
        $tongbinhluan = Binhluan::with('user')->where('phim_id', $chitietphim->id)->orderBy('id', 'DESC')->count();
        foreach ($phimlienquan as $key => $item) {
            $item->tbdanhgia = number_format($item->tbdanhgia(), 1);
        }
        // Đánh giá phim
        $rating = Danhgia::where('phim_id', $chitietphim->id)->avg('sao');
        $rating = number_format($rating, 1);
        $luotdanhgia = Danhgia::where('phim_id', $chitietphim->id)->count();
        //kiểm tra yêu thích
        $yeuthich_check = Yeuthich::where('phim_id', $chitietphim->id)->where('user_id', $user->id)->count();
        return view('user.layout_user.chitietphim', compact('user', 'danhmuc', 'theloai', 'quocgia', 'chitietphim', 'phimlienquan', 'tapphim_1', 'binhluan', 'tongbinhluan', 'rating', 'luotdanhgia', 'yeuthich_check'));
    }

    public function xemphim($slug, $tap)
    {
        $danhmuc = Danhmuc::orderBy('sapxephang', 'ASC')->where('trangthai', 1)->get();
        $theloai = Theloai::orderBy('sapxephang', 'ASC')->where('trangthai', 1)->get();
        $quocgia = Quocgia::orderBy('sapxephang', 'ASC')->where('trangthai', 1)->get();
        $chitietphim = Phim::with('danhmuc', 'phim_theloai', 'quocgia', 'tapphim')->where('slug', $slug)->where('trangthai', 1)->first();
        $phimlienquan = Phim::with('danhmuc', 'theloai', 'quocgia')->where('danhmuc_id', $chitietphim->danhmuc->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug', [$slug])->get();
        if (isset($tap)) {
            $sotapphim = $tap;
            $sotapphim = substr($tap, 4);
            $tapphim = Tapphim::where('phim_id', $chitietphim->id)->where('tap', $sotapphim)->first();
        } else {
            $sotapphim = 1;
            $tapphim = Tapphim::where('phim_id', $chitietphim->id)->where('tap', $sotapphim)->first();
        }
        $phimlienquan = Phim::with('danhmuc', 'theloai', 'quocgia')->where('danhmuc_id', $chitietphim->danhmuc->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug', [$slug])->get();
        foreach ($phimlienquan as $key => $item) {
            $item->tbdanhgia = number_format($item->tbdanhgia(), 1);
        }
        $user = Auth::user();
        $lichsuphim_check = Lichsuphim::where('user_id', $user->id)->where('phim_id', $chitietphim->id)->count();
        if ($lichsuphim_check > 0) {
            Lichsuphim::where('user_id', $user->id)->where('phim_id', $chitietphim->id)->delete();
            $lichsuphim = new Lichsuphim();
            $lichsuphim->user_id = $user->id;
            $lichsuphim->phim_id = $chitietphim->id;
            $lichsuphim->save();
        } else {

            $lichsuphim = new Lichsuphim();
            $lichsuphim->user_id = $user->id;
            $lichsuphim->phim_id = $chitietphim->id;
            $lichsuphim->save();
        }

        $tientrinh = Tientrinhxemphim::where('user_id',$user->id)->where('tapphim_id',$tapphim->id)->first();
        // dd($chitietphim);
        return view('user.layout_user.xemphim', compact('phimlienquan', 'user', 'danhmuc', 'theloai', 'quocgia', 'chitietphim', 'phimlienquan', 'tapphim', 'sotapphim', 'tientrinh'));
    }

    public function tapphim()
    {
        $danhmuc = Danhmuc::orderBy('sapxephang', 'ASC')->where('trangthai', 1)->get();
        $theloai = Theloai::orderBy('sapxephang', 'ASC')->where('trangthai', 1)->get();
        $quocgia = Quocgia::orderBy('sapxephang', 'ASC')->where('trangthai', 1)->get();
        $user = Auth::user();
        return view('user.layout_user.tapphim', compact('user', 'danhmuc', 'theloai', 'quocgia'));
    }

    public function danhsachyeuthich()
    {
        $user = Auth::user();
        $danhmuc = Danhmuc::orderBy('sapxephang', 'ASC')->where('trangthai', 1)->get();
        $theloai = Theloai::orderBy('sapxephang', 'ASC')->where('trangthai', 1)->get();
        $quocgia = Quocgia::orderBy('sapxephang', 'ASC')->where('trangthai', 1)->get();
        // $user = User::find(1);
        $phim = $user->phimyeuthich()->orderBy('yeuthiches.id', 'DESC')->paginate(12);
        // $phim=Yeuthich::with('phim')->where('user_id',$user->id)->paginate(12);
        foreach ($phim as $key => $item) {
            $item->tbdanhgia = number_format($item->tbdanhgia(), 1);
        }
        // dd($phim[1]->tbdanhgia());
        return view('user.layout_user.phimyeuthich', compact('user', 'danhmuc', 'theloai', 'quocgia', 'phim'));
    }

    public function lichsuxemphim()
    {
        $user = Auth::user();
        $danhmuc = Danhmuc::orderBy('sapxephang', 'ASC')->where('trangthai', 1)->get();
        $theloai = Theloai::orderBy('sapxephang', 'ASC')->where('trangthai', 1)->get();
        $quocgia = Quocgia::orderBy('sapxephang', 'ASC')->where('trangthai', 1)->get();
        // $user = User::find(1);
        $phim = $user->phimlichsu()->orderBy('lichsuphims.id', 'DESC')->paginate(12);
        // $phim=Yeuthich::with('phim')->where('user_id',$user->id)->paginate(12);
        foreach ($phim as $key => $item) {
            $item->tbdanhgia = number_format($item->tbdanhgia(), 1);
        }
        // dd($phim[1]->tbdanhgia());
        // $lichsuphim=Lichsuphim::where('user_id',$user->id)->paginate(12);
        return view('user.layout_user.lichsuphim', compact('user', 'danhmuc', 'theloai', 'quocgia', 'phim',));
    }

    public function trangchuadmin()
    {
        $user = Auth::user();
        return redirect()->route('thongke');
    }

    //bình luận
    public function binhluan(Request $request)
    {
        // $data= $request->all();
        $binhluan = new Binhluan();
        $binhluan->user_id = $request->input('user_id');
        $binhluan->phim_id = $request->input('phim_id');;
        $binhluan->noidung = $request->input('content');;
        $binhluan->save();
        $dt = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        return response()->json([
            'success' => true,
            'message' => 'Comment added successfully.',
            'ngay' => $dt
        ]);
    }

    //đánh giá sao
    public function danhgiasao(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();
        $rating_count = Danhgia::where('phim_id', $data['movie_id'])->where('user_id', $user->id)->count();
        if ($rating_count > 0) {
            echo 'exist';
        } else {
            $rating = new Danhgia();
            $rating->phim_id = $data['movie_id'];
            $rating->sao = $data['index'];
            $rating->user_id = $user->id;
            $rating->save();
            echo 'done';
        }
    }
    //yêu thích
    public function yeuthich(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();
        $yeuthich = new Yeuthich();
        $yeuthich->user_id = $user->id;
        $yeuthich->phim_id = $data['phim_id'];;
        $yeuthich->save();
        return response()->json([
            'success' => true,
        ]);
    }
    // hủy thích
    public function huyyeuthich(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();
        Yeuthich::where('phim_id', $data['phim_id'])->where('user_id', $user->id)->delete();
        return response()->json([
            'success' => true,
        ]);
    }

    //Tìm kiếm phim
    public function timkiem()
    {
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $danhmuc = Danhmuc::orderBy('sapxephang', 'ASC')->where('trangthai', 1)->get();
            $theloai = Theloai::orderBy('sapxephang', 'ASC')->where('trangthai', 1)->get();
            $quocgia = Quocgia::orderBy('sapxephang', 'ASC')->where('trangthai', 1)->get();
            $phim = Phim::where('tieude', 'LIKE', '%' . $search . '%')->paginate(12);
            foreach ($phim as $key => $item) {
                $item->tbdanhgia = number_format($item->tbdanhgia(), 1);
            }
            $user = Auth::user();
            // dd($phim[0]->danhgia[0]->avg('sao'));
            return view('user.layout_user.timkiem', compact('user', 'danhmuc', 'theloai', 'quocgia', 'search', 'phim'));
        } else {
            return redirect()->to('/trang-chu');
        }
    }
    public function timkiemanh(Request $request){
        $user = Auth::user();
        $danhmuc = Danhmuc::orderBy('sapxephang', 'ASC')->where('trangthai', 1)->get();
        $theloai = Theloai::orderBy('sapxephang', 'ASC')->where('trangthai', 1)->get();
        $quocgia = Quocgia::orderBy('sapxephang', 'ASC')->where('trangthai', 1)->get();
        // Lấy file ảnh từ request
        $image = $request->file('searchanh');

        // Nếu không có ảnh được tải lên
        if (!$image) {
            return redirect()->back()->withErrors(['message' => 'Vui lòng chọn ảnh']);
        }

        // Tạo đường dẫn cho file ảnh
        $path = $image->store('uploads');

        // Lấy đường dẫn tuyệt đối cho file ảnh
        $absolutePath = storage_path("app/$path");

        // Đọc nội dung của file ảnh
        $imageContent = file_get_contents($absolutePath);

        // Tạo request đến API của Google để tìm kiếm phim
        $client = new Client(['base_uri' => 'https://www.googleapis.com/']);
        $response = $client->request('POST', 'https://vision.googleapis.com/v1/images:annotate', [
            'query' => ['key' => 'AIzaSyBGRVqdGox0eb0PP3IqYl4F8QagdaJVRKU'],
            'json' => [
                'requests' => [
                    [
                        'image' => [
                            'content' => base64_encode($imageContent)
                        ],
                        'features' => [
                            [
                                'type' => 'WEB_DETECTION',
                                'maxResults' => 1
                            ]
                        ]
                    ]
                ]
            ]
        ]);

        // Lấy kết quả trả về từ API
        $results = json_decode($response->getBody()->getContents(), true);

        // Lấy ra các kết quả phù hợp nhất với hình ảnh
        $bestGuessLabels = $results['responses'][0]['webDetection']['bestGuessLabels'];

        // Nếu không tìm thấy kết quả nào phù hợp
        if (empty($bestGuessLabels)) {
            return redirect()->back()->withErrors(['message' => 'Không tìm thấy kết quả phù hợp']);
        }

        // Lấy tên phim từ kết quả phù hợp nhất
        $movieName = $bestGuessLabels[0]['label'];

        unlink($absolutePath);
        
        $phim = Phim::search($movieName)->paginate(12);

        foreach ($phim as $key => $item) {
            $item->tbdanhgia = number_format($item->tbdanhgia(), 1);
        }
        $search=$movieName;
        return view('user.layout_user.timkiem', compact('user', 'danhmuc', 'theloai', 'quocgia', 'search', 'phim'));
    }

    //Lưu tiến trình xem phim của người dùng
    public function luutientrinh(Request $request){
        $data = $request->all();
        // return dd($data);
        $user = Auth::user();
        $checktientrinh = Tientrinhxemphim::where('user_id',$user->id)->where('tapphim_id',$data['tapphim_id'])->first();
        if(!empty($checktientrinh)){
            $tientrinh = Tientrinhxemphim::find($checktientrinh->id);
            $tientrinh->user_id = $user->id;
            $tientrinh->tapphim_id = $data['tapphim_id'];
            $tientrinh->thoigian = $data['currentTime'];
            $tientrinh->save();
            return response()->json([
                'success' => true,
            ]);
        }else{
            $tientrinh = new Tientrinhxemphim();
            $tientrinh->user_id = $user->id;
            $tientrinh->tapphim_id = $data['tapphim_id'];
            $tientrinh->thoigian = $data['currentTime'];
            $tientrinh->save();
            return response()->json([
                'success' => true,
            ]);
        }
        
    }
    
}
