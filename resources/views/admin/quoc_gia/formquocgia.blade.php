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
            <h1 class="m-0">Quốc Gia</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Trang Chủ</a></li>
              <li class="breadcrumb-item active">Quốc Gia</li>
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
              @if (!isset($editquocgia))
              {!! Form::open(['route'=>'quoc-gia.store','method'=>'POST']) !!}
              @else
              {!! Form::open(['route'=>['quoc-gia.update',$editquocgia->id],'method'=>'PUT']) !!}
              @endif
                <div class="form-group{{ $errors->has('tieude') ? ' has-error' : '' }}">
                {!! Form::label('tieude', 'Tiêu Đề') !!}
                {!! Form::text('tieude', isset($editquocgia) ? $editquocgia->tieude : '', ['onkeyup'=>'ChangeToSlug()','id'=>'slug','class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('tieude') }}</small>
                </div>
                <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                  {!! Form::label('slug', 'Slug') !!}
                  {!! Form::text('slug', isset($editquocgia) ? $editquocgia->slug : '', ['readonly','id'=>'convert_slug', 'class' => 'form-control', 'required' => 'required']) !!}
                  <small class="text-danger">{{ $errors->first('slug') }}</small>
                  </div>
                <div class="form-group{{ $errors->has('inputname') ? ' has-error' : '' }}">
                {!! Form::label('mota', 'Mô Tả') !!}
                {!! Form::textarea('mota', isset($editquocgia) ? $editquocgia->mota : '', ['class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('mota') }}</small>
                </div>
                <div class="form-group{{ $errors->has('trangthai') ? ' has-error' : '' }}">
                {!! Form::label('trangthai', 'Trạng Thái') !!}
                {!! Form::select('trangthai',['1'=>'Hiển Thị','0'=>'Không Hiển Thị'], isset($editquocgia) ? $editquocgia->trangthai : '', ['id' => 'trangthai', 'class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('trangthai') }}</small>
                </div>
                @if (!isset($editquocgia))
                {!! Form::submit('Thêm dữ liệu', ['class' => 'btn btn-info pull-right']) !!}
              
                @else
                {!! Form::submit('Cập nhật', ['class' => 'btn btn-info pull-right']) !!}
              
              @endif
              <a href="{{route('quoc-gia.create')}}" class="btn btn-secondary">hủy bỏ</a>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="card card-primary">
            <div class="card-body">
                <table class="table" id="table_quocgia">
                    <thead>
                      <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Tiêu Đề</th>
                        <th scope="col">Mô Tả</th>
                        <th scope="col">Trạng Thái</th>
                        <th scope="col">#</th>
                      </tr>
                    </thead>
                    <tbody id="sapxepbang_quocgia">
                      @foreach ($listquocgia as $key => $item)
                          
                      <tr id="{{$item->id}}">
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$item->tieude}}</td>
                        <td>{{$item->mota}}</td>
                        <td>
                          @if ($item->trangthai==0)
                              Không hiển thị
                          @else 
                              Hiển thị
                          @endif
                        </td>
                        <td>
                          <div class="row" style="display: flex; justify-content: space-evenly;">

                            {!! Form::open(['method' => 'DELETE', 'route' => ['quoc-gia.destroy',$item->id],'id'=> 'quocgia'.$item->id,'data-id'=> $item->id  ,'class' => 'form-horizontal deletequocgia']) !!}
                            {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            <a href="{{route('quoc-gia.edit',$item->id)}}" class="btn btn-warning">Sửa</a>
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