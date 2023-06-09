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
            <h1 class="m-0">Tập Phim</h1>
          </div><!-- /.col -->
          <div class="col-sm-6"breadcrumb>
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Trang Chủ</a></li>
              <li class="-item active">Tập Phim</li>
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
              @if (!isset($edittapphim))
              {!! Form::open(['route'=>'tap-phim.store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
              @else
              {!! Form::open(['route'=>['tap-phim.update',$edittapphim->id],'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
              @endif
                <div class="form-group{{ $errors->has('chonphim') ? ' has-error' : '' }}">
                {!! Form::label('chonphim', 'Chọn Phim') !!}
                {!! Form::select('chonphim',[''=>'Chọn Phim','Phim gần nhất'=>$listphim], isset($edittapphim) ? $edittapphim->phim_id : '', ['id' => 'chonphim', 'class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('chonphim') }}</small>
                </div>
                {{-- <div class="form-group{{ $errors->has('uploadphim') ? ' has-error' : '' }}">
                  {!! Form::label('uploadphim', 'Tải Phim Lên') !!}
                  {!! Form::file('uploadphim', ['class' => 'form-control-file', isset($edittapphim) ? '' : 'required' => 'required']) !!}
                  <small class="text-danger">{{ $errors->first('uploadphim') }}</small>
                  @if(!empty($edittapphim))
                  <video controls>
                    <source src="{{asset('uploads/phim/'.$edittapphim->linkphim)}}">
                  </video>
                  @endif
                  </div> --}}
                  <div class="form-group{{ $errors->has('linkphim') ? ' has-error' : '' }}">
                  {!! Form::label('linkphim', 'Link Phim') !!}
                  {!! Form::text('linkphim', isset($edittapphim) ? $edittapphim->linkphim : '', ['class' => 'form-control', 'required' => 'required']) !!}
                  <small class="text-danger">{{ $errors->first('linkphim') }}</small>
                  </div>
                  <div class="form-group{{ $errors->has('chontap') ? ' has-error' : '' }}">
                    {!! Form::label('chontap', 'Chọn Tập') !!}
                    @if(!empty($edittapphim))
                    <select name="chontapupdate" class="form-control" readonly>
                      <option value="{{$edittapphim->tap}}">{{$edittapphim->tap}}</option>
                    </select>
                    {{-- {!! Form::select('chontap', isset($edittapphim) ? $edittapphim->tap : '', ['class' => 'form-control', ]) !!} --}}
                    @else
                    <select name="chontap" class="form-control" id="chontap">
                      <option>Chọn Tập</option>
                      <option value=""></option>
                    </select>
                    @endif
                    <small class="text-danger">{{ $errors->first('chontap') }}</small>
                    </div>
                @if (!isset($edittapphim))
                {!! Form::submit('Thêm dữ liệu', ['class' => 'btn btn-info pull-right']) !!}
                @else
                {!! Form::submit('Cập nhật', ['class' => 'btn btn-info pull-right']) !!}
              
              @endif
              <a href="{{route('tap-phim.create')}}" class="btn btn-secondary">hủy bỏ</a>
                {!! Form::close() !!}
            </div>
            
        </div>
        <div class="card card-primary">
            <div class="card-body">
                <table class="table" id="table_tap_phim">
                    <thead>
                      <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Tiêu Đề</th>
                        <th scope="col">Tập</th>
                        <th scope="col">#</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($listtapphim as $key => $item)
                          
                      <tr >
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$item->phim->tieude}}</td>
                        <td>{{$item->tap}}</td>
                        <td>
                          <div class="row" style="display: flex; justify-content: space-evenly;">

                            {!! Form::open(['method' => 'DELETE', 'route' => ['tap-phim.destroy',$item->id],'id'=> 'tapphim'.$item->id,'data-id'=> $item->id  ,'class' => 'form-horizontal deletetapphim']) !!}
                            {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            <a href="{{route('tap-phim.edit',$item->id)}}" class="btn btn-warning">Sửa</a>
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