@extends('admin.index_admin')

@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Thống Kê</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Thống Kê</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $tongphim }}</h3>
                                <p>Bộ Phim</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('phim.create') }}" class="small-box-footer">Chi Tiết <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $tongtapphim }}</h3>
                                <p>Tập Phim</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('tap-phim.create') }}" class="small-box-footer">Chi Tiết <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $tonguser }}</h3>
                                <p>Người Dùng</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{ route('nguoi-dung.create') }}" class="small-box-footer">Chi Tiết <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $tonggoi }}</h3>
                                <p>Gói</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{ route('goi-dich-vu.create') }}" class="small-box-footer">Chi Tiết <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-8">

                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Doanh Thu Gói</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <form action="{{route('postthongke')}}" method="POST">
                                        @csrf
                                        <input type="date" name="ngaybatdau" @if(!empty($ngayBatDau)) value="{{ $ngayBatDau }}" @endif>
                                        <input type="date" name="ngayketthuc" @if(!empty($ngayKetThuc)) value="{{ $ngayKetThuc }}" @endif>
                                        <button class="btn btn-success" type="submit">Lọc</button>
                                    </form>

                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">STT</th>
                                            <th scope="col">Tên Gói</th>
                                            <th scope="col">Số Gói Đã bán</th>
                                            <th scope="col">Tổng Tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Gói Cơ Bản</td>
                                            <td>{{ $goi1->count() }}</td>
                                            <td>{{ number_format($goi1->count() * 200000, 0, '.', '.')}} đ</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Gói Phổ Thông</td>
                                            <td>{{ $goi2->count() }}</td>
                                            <td>{{ number_format($goi2->count() * 500000, 0, '.', '.')}} đ</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>Gói Tiêu Chuẩn</td>
                                            <td>{{ $goi3->count() }}</td>
                                            <td>{{ number_format($goi3->count() * 900000, 0, '.', '.')}} đ</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Gói Cao Cấp</td>
                                            <td>{{ $goi4->count() }}</td>
                                            <td>{{ number_format($goi4->count() * 1500000, 0, '.', '.')}} đ</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <span style="float: right;font-size: x-large; color:red"> Tổng:
                                    {{ number_format( $goi1->count() * 200000 + $goi2->count() * 500000 + $goi3->count() * 900000 + $goi4->count() * 1500000 , 0, '.', '.')}} đ</span>
        
                            </div>
        
                        </div>
                    </div>
                    <div class="col-md-4">

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Tương Tác</h3>
                            </div>
                            <div class="card-body">
                                <div class="">
                                    
        
                                        <div class="info-box mb-3 bg-warning">
                                            <span style="color: white" class="info-box-icon"><i class="far fa-star"></i></span>
                                            <div class="info-box-content" style="color: white">
                                                <span class="info-box-text">Đánh Giá</span>
                                                <span class="info-box-number">{{$tongdanhgia}} Lượt</span>
                                            </div>
            
                                        </div>
                                    
        
                                    
        
                                        {{-- <div class="info-box mb-3 bg-success">
                                            <span class="info-box-icon"><i class="fas fa-cloud-download-alt"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Mentions</span>
                                                <span class="info-box-number">92,050</span>
                                            </div>
            
                                        </div> --}}
                                    
                                    
        
                                        <div class="info-box mb-3 bg-danger">
                                            <span class="info-box-icon"><i class="far fa-heart "></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Yêu Thích</span>
                                                <span class="info-box-number">{{$tongyeuthich}} Lượt</span>
                                            </div>
            
                                        </div>
                                    
                                    
        
                                        <div class="info-box mb-3 bg-info">
                                            <span class="info-box-icon"><i class="far fa-comment"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Bình Luận</span>
                                                <span class="info-box-number">{{$tongbinhluan}} Lượt</span>
                                            </div>
                                        </div>
                                    
                                </div>
                            </div>
        
                        </div>
                    </div>
                </div>
        </section>

    </div>
@endsection
