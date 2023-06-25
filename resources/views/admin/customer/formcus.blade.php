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
            <h1 class="m-0">Người Dùng</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Trang Chủ</a></li>
              <li class="breadcrumb-item active">Người Dùng</li>
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
              @if (!isset($editcus))
              {!! Form::open(['route'=>'nguoi-dung.store','method'=>'POST']) !!}
              @else
              {!! Form::open(['route'=>['nguoi-dung.update',$editcus->id],'method'=>'PUT']) !!}
              @endif
                <div class="form-group{{ $errors->has('ten') ? ' has-error' : '' }}">
                {!! Form::label('ten', 'Họ Tên') !!}
                {!! Form::text('ten', isset($editcus) ? $editcus->name : '', ['onkeyup'=>'ChangeToSlug()','id'=>'slug','class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('ten') }}</small>
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  {!! Form::label('email', 'Email') !!}
                  {!! Form::text('email', isset($editcus) ? $editcus->email : '', [ 'class' => 'form-control', 'required' => 'required']) !!}
                  <small class="text-danger">{{ $errors->first('email') }}</small>
                  </div>
                {{-- <div class="form-group{{ $errors->has('inputname') ? ' has-error' : '' }}">
                {!! Form::label('mota', 'Mô Tả') !!}
                {!! Form::textarea('mota', isset($editcus) ? $editcus->mota : '', ['class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('mota') }}</small>
                </div> --}}
                @if (!isset($editcus))                
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                {!! Form::label('password', 'Password') !!}
                {!! Form::password('password', ['class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('password') }}</small>
                </div>
                @endif
                @if(!empty($user_goi))
                <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                {!! Form::label('date', 'Ngày kết thúc gói') !!}
                {!! Form::date('date', $user_goi->end_date, ['class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('date') }}</small>
                </div>
                @else

                @endif
                {{-- <div class="form-group{{ $errors->has('trangthai') ? ' has-error' : '' }}">
                {!! Form::label('trangthai', 'Trạng Thái') !!}
                {!! Form::select('trangthai',['1'=>'Hiển Thị','0'=>'Không Hiển Thị'], isset($editcus) ? $editcus->trangthai : '', ['id' => 'trangthai', 'class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('trangthai') }}</small>
                </div> --}}
                @if (!isset($editcus))
                {!! Form::submit('Thêm dữ liệu', ['class' => 'btn btn-info pull-right']) !!}
              
                @else
                {!! Form::submit('Cập nhật', ['class' => 'btn btn-info pull-right']) !!}
              
              @endif
              <a href="{{route('nguoi-dung.create')}}" class="btn btn-secondary">hủy bỏ</a>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="card card-primary">
            <div class="card-body">
                <table class="table" id="table_danhmuc">
                    <thead>
                      <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Email</th>
                        <th scope="col">Vai Trò</th>
                        <th scope="col">#</th>
                      </tr>
                    </thead>
                    <tbody id="sapxepbang_danhmuc">
                      @foreach ($listuser as $key => $item)
                          
                      <tr id="{{$item->id}}">
                        <th scope="row">{{++$key}}</th>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>
                            @if ($item->role==0)
                                Khách Hàng
                            @else 
                                Admin
                            @endif
                          </td>
                        <td>
                          <div class="row" style="display: flex; justify-content: space-evenly;">

                            {!! Form::open(['method' => 'DELETE', 'route' => ['nguoi-dung.destroy',$item->id],'id'=> 'danhmuc'.$item->id,'data-id'=> $item->id  ,'class' => 'form-horizontal deletedanhmuc']) !!}
                            {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            <a href="{{route('nguoi-dung.edit',$item->id)}}" class="btn btn-warning">Sửa</a>
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