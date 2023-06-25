@extends('admin.index_admin')

@section('content')
@if(Session::has('error'))
        <script>
            document.addEventListener("DOMContentLoaded", function (event) {
                Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: '{{Session::get('error')}}',
                showConfirmButton: false,
                timer: 1500
                })
            })
        </script>
        @endif
        @if(Session::has('success'))
            <script>
                document.addEventListener("DOMContentLoaded", function (event) {
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '{{Session::get('success')}}',
                    showConfirmButton: false,
                    timer: 1500
                    })
                })
            </script>
        @endif
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Gói Dịch Vụ</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Trang Chủ</a></li>
              <li class="breadcrumb-item active">Gói Dịch Vụ</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-body">
              @if (!isset($editgoidichvu))
              {!! Form::open(['route'=>'goi-dich-vu.store','method'=>'POST']) !!}
              @else
              {!! Form::open(['route'=>['goi-dich-vu.update',$editgoidichvu->id],'method'=>'PUT']) !!}
              @endif
                <div class="form-group{{ $errors->has('tieude') ? ' has-error' : '' }}">
                {!! Form::label('tieude', 'Tiêu Đề') !!}
                {!! Form::text('tieude', isset($editgoidichvu) ? $editgoidichvu->name : '', ['id'=>'slug','class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('tieude') }}</small>
                </div>
                <div class="form-group{{ $errors->has('gia') ? ' has-error' : '' }}">
                {!! Form::label('gia', 'Giá (VND)') !!}
                {!! Form::number('gia', isset($editgoidichvu) ? $editgoidichvu->gia : '', ['class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('gia') }}</small>
                </div>
                <div class="form-group{{ $errors->has('thoigian') ? ' has-error' : '' }}">
                    {!! Form::label('thoigian', 'Thời Hạn (Ngày)') !!}
                    {!! Form::number('thoigian', isset($editgoidichvu) ? $editgoidichvu->thoigian : '', ['class' => 'form-control', 'required' => 'required']) !!}
                    <small class="text-danger">{{ $errors->first('thoigian') }}</small>
                    </div>
                <div class="form-group{{ $errors->has('mota') ? ' has-error' : '' }}">
                {!! Form::label('mota', 'Mô Tả') !!}
                {!! Form::textarea('mota', isset($editgoidichvu) ? $editgoidichvu->mota : '', ['class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('mota') }}</small>
                </div>
                <div class="form-group{{ $errors->has('trangthai') ? ' has-error' : '' }}">
                {!! Form::label('trangthai', 'Trạng Thái') !!}
                {!! Form::select('trangthai',['1'=>'Hiển Thị','0'=>'Không Hiển Thị'], isset($editgoidichvu) ? $editgoidichvu->trangthai : '', ['id' => 'trangthai', 'class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('trangthai') }}</small>
                </div>
                @if (!isset($editgoidichvu))
                {!! Form::submit('Thêm dữ liệu', ['class' => 'btn btn-info pull-right']) !!}
              
                @else
                {!! Form::submit('Cập nhật', ['class' => 'btn btn-info pull-right']) !!}
              
              @endif
              <a href="{{route('goi-dich-vu.create')}}" class="btn btn-secondary">hủy bỏ</a>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="card card-primary">
            <div class="card-body">
                <table class="table" id="table_goidichvu">
                    <thead>
                      <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Tiêu Đề</th>
                        <th scope="col">Mô Tả</th>
                        <th scope="col">Giá (VNĐ)</th>
                        <th scope="col">Trạng Thái</th>
                        <th scope="col">#</th>
                      </tr>
                    </thead>
                    <tbody id="sapxepbang_goidichvu">
                      @foreach ($listgoidichvu as $key => $item)
                          
                      <tr id="{{$item->id}}">
                        <th scope="row">{{$item->sapxephang}}</th>
                        <td>{{$item->name}}</td>
                        <td>{{$item->mota}}</td>
                        <td>{{number_format($item->gia, 0, '.', '.')}} đ</td>
                        <td>
                          @if ($item->trangthai==0)
                              Không hiển thị
                          @else 
                              Hiển thị
                          @endif
                        </td>
                        <td>
                          <div class="row" style="display: flex; justify-content: space-evenly;">

                            {!! Form::open(['method' => 'DELETE', 'route' => ['goi-dich-vu.destroy',$item->id],'id'=> 'goidichvu'.$item->id,'data-id'=> $item->id  ,'class' => 'form-horizontal deletegoidichvu']) !!}
                            {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            <a href="{{route('goi-dich-vu.edit',$item->id)}}" class="btn btn-warning">Sửa</a>
                          </div>
                        </td>
                      </tr>
                      @endforeach
                      
                    </tbody>
                  </table>
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  @endsection