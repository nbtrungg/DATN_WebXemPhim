<?php

use App\Http\Controllers\User\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\IndexController;
//Admin Controller
use App\Http\Controllers\Admin\PhimController;
use App\Http\Controllers\Admin\DanhMucController;
use App\Http\Controllers\Admin\QuocGiaController;
use App\Http\Controllers\Admin\TapPhimController;
use App\Http\Controllers\Admin\TheLoaiController;
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
Route:: middleware(['auth'])->group(function(){
    Route::get('/users/dangky',[LoginController::class,'getDangKy'])->name('dangky');
    Route::post('/vnpay',[LoginController::class,'vnpay'])->name('vnpay');
    //trang xem phim
    Route::group(['middleware' => 'checkdichvu'], function () {
        // các route cần kiểm tra gói dịch vụ
        Route::get('/trang-chu',[IndexController::class,'trangchu'])->name('trangchu');
        Route::get('/danh-muc/{slug}',[IndexController::class,'danhmuc'])->name('danhmuc');
        Route::get('/the-loai/{slug}',[IndexController::class,'theloai'])->name('theloai');
        Route::get('/quoc-gia/{slug}',[IndexController::class,'quocgia'])->name('quocgia');
        Route::get('/chi-tiet-phim/{slug}',[IndexController::class,'chitietphim'])->name('chitietphim');
        Route::get('/xem-phim/{slug}/{tap}',[IndexController::class,'xemphim'])->name('xemphim');
        Route::get('/tap-phim',[IndexController::class,'tapphim'])->name('tapphim');
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
        });
        //route sắp xếp bảng
        Route::post('sapxepbang-danhmuc',[DanhMucController::class,'sapxepbang']);
        Route::post('sapxepbang-theloai',[TheLoaiController::class,'sapxepbang']);
        Route::post('sapxepbang-quocgia',[QuocGiaController::class,'sapxepbang']);
        Route::get('/chontapphim',[TapPhimController::class,'chontapphim'])->name('chontapphim');

});

