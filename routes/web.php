<?php

use App\Http\Controllers\Admin\CusController;
use App\Http\Controllers\User\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\IndexController;
//Admin Controller
use App\Http\Controllers\Admin\PhimController;
use App\Http\Controllers\Admin\DanhMucController;
use App\Http\Controllers\Admin\GoiDichVuController;
use App\Http\Controllers\Admin\QuocGiaController;
use App\Http\Controllers\Admin\TapPhimController;
use App\Http\Controllers\Admin\TheLoaiController;
use App\Models\Goidichvu;
use App\Http\Controllers\Admin\ThongKeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login_user');
});

// USER
//login
Route::get('/users/login',[LoginController::class,'getLogin'])->name('login_user');
Route::get('/users/logout',[LoginController::class,'logout_user'])->name('logout_user');
Route::post('/users/login',[LoginController::class,'postLogin'])->name('post_login_user');
Route::post('/users/dangky',[LoginController::class,'postdangky'])->name('post_dangky_user');
Route::get('thanh-cong',[LoginController::class,'thanhcong'])->name('thanhcong');
Route::post('dktheloai',[LoginController::class,'dktheloai'])->name('dktheloai');

//check email trùng
Route::post('/checkemail',[LoginController::class,'checkEmail']);

Route:: middleware(['auth'])->group(function(){
    Route::get('/users/dangky',[LoginController::class,'getDangKy'])->name('dangky');
    Route::post('/vnpay',[LoginController::class,'vnpay'])->name('vnpay');
    //trang xem phim
    Route::group(['middleware' => 'checkdichvu'], function () {
        // các route cần kiểm tra gói dịch vụ
        Route::group(['middleware' => 'checktheloai'], function () {
            Route::get('/trang-chu',[IndexController::class,'trangchu'])->name('trangchu');
            Route::get('/danh-muc/{slug}',[IndexController::class,'danhmuc'])->name('danhmuc');
            Route::get('/the-loai/{slug}',[IndexController::class,'theloai'])->name('theloai');
            Route::get('/quoc-gia/{slug}',[IndexController::class,'quocgia'])->name('quocgia');
            Route::get('/chi-tiet-phim/{slug}',[IndexController::class,'chitietphim'])->name('chitietphim');
            Route::get('/xem-phim/{slug}/{tap}',[IndexController::class,'xemphim'])->name('xemphim');
            Route::get('/tap-phim',[IndexController::class,'tapphim'])->name('tapphim');
            Route::get('/danh-sach-yeu-thich',[IndexController::class,'danhsachyeuthich'])->name('danhsachyeuthich');
            Route::get('/lich-su-xem-phim',[IndexController::class,'lichsuxemphim'])->name('lichsuxemphim');
            Route::get('/tim-kiem',[IndexController::class,'timkiem'])->name('timkiem');
            Route::post('/tim-kiem-anh',[IndexController::class,'timkiemanh'])->name('timkiemanh');
        


            // bình luận
            Route::post('/binhluan',[IndexController::class,'binhluan']);
            //Đánh giá sao
            Route::post('/danhgiasao',[IndexController::class,'danhgiasao']);
            Route::post('/yeuthich',[IndexController::class,'yeuthich']);
            Route::post('/huyyeuthich',[IndexController::class,'huyyeuthich']);
            Route::post('/luutientrinh',[IndexController::class,'luutientrinh']);
        });
    });
});

//ADMIN
Route::get('/admin/login',[LoginController::class,'getLoginAdmin'])->name('login_admin');
Route::post('/admin/login',[LoginController::class,'postLoginAdmin'])->name('post_login_admin');
Route::get('/admin/logout',[LoginController::class,'logout_admin'])->name('logout_admin');

    Route::group(['middleware' => 'admin'], function () {

        Route::get('/trang-chu-admin',[IndexController::class,'trangchuadmin'])->name('trangchuadmin');
        
        route::prefix('admin')->group(function(){
        
            Route::resource('danh-muc',DanhMucController::class);
            Route::resource('the-loai',TheLoaiController::class);
            Route::resource('quoc-gia',QuocGiaController::class);
            Route::resource('phim',PhimController::class);
            Route::resource('tap-phim',TapPhimController::class);
            Route::resource('goi-dich-vu',GoiDichVuController::class);
            Route::resource('nguoi-dung',CusController::class);
            Route::get('them-tap-phim/{id}',[TapPhimController::class,'themtapphim'])->name('them-tap-phim');
            Route::get('thong-ke',[ThongKeController::class,'thongke'])->name('thongke');
            Route::post('thong-ke',[ThongKeController::class,'postthongke'])->name('postthongke');

        });
        //route sắp xếp bảng
        Route::post('sapxepbang-danhmuc',[DanhMucController::class,'sapxepbang']);
        Route::post('sapxepbang-theloai',[TheLoaiController::class,'sapxepbang']);
        Route::post('sapxepbang-quocgia',[QuocGiaController::class,'sapxepbang']);
        Route::post('sapxepbang-goidichvu',[GoiDichVuController::class,'sapxepbang']);
        Route::get('/chontapphim',[TapPhimController::class,'chontapphim'])->name('chontapphim');
        
});

