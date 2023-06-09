@extends('admin.index_admin')

@section('content')
    @if (Session::has('error'))
        <script>
            document.addEventListener("DOMContentLoaded", function(event) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: '{{ Session::get('error') }}',
                    showConfirmButton: false,
                    timer: 1500
                })
            })
        </script>
    @endif
    @if (Session::has('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function(event) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '{{ Session::get('success') }}',
                    showConfirmButton: false,
                    timer: 1500
                })
            })
        </script>
    @endif
    <style>
        .form-check-inline {
            display: inline-block;
            width: 19%;
            /* chia đều cho 4 cột */
            box-sizing: border-box;
            /* giữa các padding, border không ảnh hưởng đến chiều rộng của ô */
            /* padding-right: 50px; */
            /* tạo khoảng cách giữa các ô */
        }

        .checkbox-container {
            display: flex;
            /* đảm bảo các ô được sắp xếp trên cùng một dòng */
            flex-wrap: wrap;
            /* nếu không đủ chỗ thì dòng mới bắt đầu */
            margin: -10px 0;
            /* xóa khoảng cách giữa các dòng */
        }
        .checkboxlable{
          padding-right: 40px;
        }
    </style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Phim</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Trang Chủ</a></li>
                            <li class="breadcrumb-item active">Phim</li>
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
                        @if (!isset($editphim))
                            {!! Form::open(['route' => 'phim.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        @else
                            {!! Form::open([
                                'route' => ['phim.update', $editphim->id],
                                'method' => 'PUT',
                                'enctype' => 'multipart/form-data',
                            ]) !!}
                        @endif
                        <div class="form-group{{ $errors->has('tieude') ? ' has-error' : '' }}">
                            {!! Form::label('tieude', 'Tiêu Đề') !!}
                            {!! Form::text('tieude', isset($editphim) ? $editphim->tieude : '', [
                                'onkeyup' => 'ChangeToSlug()',
                                'id' => 'slug',
                                'class' => 'form-control',
                                'required' => 'required',
                            ]) !!}
                            <small class="text-danger">{{ $errors->first('tieude') }}</small>
                        </div>
                        <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                            {!! Form::label('slug', 'Slug') !!}
                            {!! Form::text('slug', isset($editphim) ? $editphim->slug : '', [
                                'id' => 'convert_slug',
                                'class' => 'form-control',
                                'required' => 'required',
                            ]) !!}
                            <small class="text-danger">{{ $errors->first('slug') }}</small>
                        </div>
                        <div class="form-group{{ $errors->has('mota') ? ' has-error' : '' }}">
                            {!! Form::label('mota', 'Mô Tả') !!}
                            {!! Form::textarea('mota', isset($editphim) ? $editphim->mota : '', [
                                'class' => 'form-control',
                                'required' => 'required',
                            ]) !!}
                            <small class="text-danger">{{ $errors->first('mota') }}</small>
                        </div>
                        <div class="form-group{{ $errors->has('sotap') ? ' has-error' : '' }}">
                            {!! Form::label('sotap', 'Số Tập') !!}
                            {!! Form::number('sotap', isset($editphim) ? $editphim->sotap : '', [
                                'class' => 'form-control',
                                'required' => 'required',
                            ]) !!}
                            <small class="text-danger">{{ $errors->first('sotap') }}</small>
                        </div>
                        <div class="form-group{{ $errors->has('thoiluong') ? ' has-error' : '' }}">
                            {!! Form::label('thoiluong', 'Thời Lượng') !!}
                            {!! Form::number('thoiluong', isset($editphim) ? $editphim->thoiluong : '', [
                                'class' => 'form-control',
                                'required' => 'required',
                            ]) !!}
                            <small class="text-danger">{{ $errors->first('thoiluong') }}</small>
                        </div>
                        <div class="form-group{{ $errors->has('chatluong') ? ' has-error' : '' }}">
                            {!! Form::label('chatluong', 'Chất Lượng') !!}
                            {!! Form::select(
                                'chatluong',
                                ['0' => 'HD', '1' => '2K', '2' => '4K'],
                                isset($editphim) ? $editphim->chatluong : '',
                                ['id' => 'chatluong', 'class' => 'form-control', 'required' => 'required'],
                            ) !!}
                            <small class="text-danger">{{ $errors->first('chatluong') }}</small>
                        </div>
                        <div class="form-group{{ $errors->has('namphim') ? ' has-error' : '' }}">
                            {!! Form::label('namphim', 'Năm Phát Hành') !!}
                            {!! Form::selectYear('namphim', date('2000'), date(today()), isset($editphim) ? $editphim->namphim : '', [
                                'class' => 'form-control',
                                'required' => 'required',
                            ]) !!}
                            <small class="text-danger">{{ $errors->first('namphim') }}</small>
                        </div>

                        <div class="form-group{{ $errors->has('trangthai') ? ' has-error' : '' }}">
                            {!! Form::label('trangthai', 'Trạng Thái') !!}
                            {!! Form::select(
                                'trangthai',
                                ['1' => 'Hiển Thị', '0' => 'Không Hiển Thị'],
                                isset($editphim) ? $editphim->trangthai : '',
                                ['id' => 'trangthai', 'class' => 'form-control', 'required' => 'required'],
                            ) !!}
                            <small class="text-danger">{{ $errors->first('trangthai') }}</small>
                        </div>
                        <div class="form-group{{ $errors->has('danhmuc') ? ' has-error' : '' }}">
                            {!! Form::label('danhmuc_id', 'Danh Mục') !!}
                            {!! Form::select('danhmuc_id', $danhmuc, isset($editphim) ? $editphim->danhmuc_id : '', [
                                'id' => 'danhmuc_id',
                                'class' => 'form-control',
                                'required' => 'required',
                            ]) !!}
                            <small class="text-danger">{{ $errors->first('danhmuc') }}</small>
                        </div>
                        {{-- <div class="form-group{{ $errors->has('theloai') ? ' has-error' : '' }}">
                {!! Form::label('theloai_id', 'Thể Loại') !!}
                {!! Form::select('theloai_id',$theloai, isset($editphim) ? $editphim->theloai_id : '', ['id' => 'theloai_id', 'class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('theloai') }}</small>
                </div> --}}
                        <div class="form-group">
                            {!! Form::label('theloai_id', 'Thể Loại') !!}<br>
                            <div class="checkbox{{ $errors->has('checkbox_id') ? ' has-error' : '' }}">
                                @foreach ($listtheloai as $key => $item)
                                <div class="form-check-inline">
                                    <label for="checkbox_id" class="checkboxlable">
                                        @if (isset($editphim))
                                            {!! Form::checkbox(
                                                'theloai[]',
                                                $item->id,
                                                isset($phim_theloai) && $phim_theloai->contains($item->id) ? true : false,
                                                ['id' => 'checkbox_id'],
                                            ) !!} {{ $item->tieude }}
                                        @else
                                            {!! Form::checkbox('theloai[]', $item->id, null, ['id' => 'checkbox_id']) !!} {{ $item->tieude }}
                                        @endif
                                    </label>
                                  </div>    
                                @endforeach
                            </div>
                            <small class="text-danger">{{ $errors->first('checkbox_id') }}</small>
                        </div>
                        <div class="form-group{{ $errors->has('quocgia') ? ' has-error' : '' }}">
                            {!! Form::label('quocgia_id', 'Quốc Gia') !!}
                            {!! Form::select('quocgia_id', $quocgia, isset($editphim) ? $editphim->quocgia_id : '', [
                                'id' => 'quocgia_id',
                                'class' => 'form-control',
                                'required' => 'required',
                            ]) !!}
                            <small class="text-danger">{{ $errors->first('quocgia') }}</small>
                        </div>
                        <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                            {!! Form::label('image', 'Ảnh') !!}
                            {!! Form::file('image', [
                                'class' => 'form-control-file',
                                isset($editphim) ? '' : 'required' => 'required',
                                'accept' => 'image/*',
                                'multiple',
                            ]) !!}
                            <small class="text-danger">{{ $errors->first('photo') }}</small>
                            @if (!empty($editphim))
                                <img style="width: 100px" src="{{ asset('uploads/anhphim/' . $editphim->hinhanh) }}"
                                    alt="">
                            @endif
                        </div>
                        @if (!isset($editphim))
                            {!! Form::submit('Thêm dữ liệu', ['class' => 'btn btn-info pull-right']) !!}
                        @else
                            {!! Form::submit('Cập nhật', ['class' => 'btn btn-info pull-right']) !!}
                        @endif
                        <a href="{{ route('phim.create') }}" class="btn btn-secondary">hủy bỏ</a>
                        {!! Form::close() !!}
                    </div>

                </div>
                <div class="card card-primary">
                    <div class="card-body">
                        <table class="table" id="table_phim">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Hình Ảnh</th>
                                    <th scope="col">Tiêu Đề</th>
                                    {{-- <th scope="col">Số Tập</th>
                                    <th scope="col">Chất Lượng</th>
                                    <th scope="col">Năm</th>
                                    <th scope="col">Thời Lượng</th>
                                    <th scope="col">Danh Mục</th>
                                    <th scope="col">Thể Loại</th> --}}
                                    <th scope="col">Quốc Gia</th>
                                    <th scope="col">Trạng Thái</th>
                                    <th scope="col">#</th>
                                </tr>
                            </thead>
                            <style>
                                .badge{
                                    font-size: 90%;
                                }
                            </style>
                            <tbody>
                                @foreach ($listphim as $key => $item)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td><img style="width: 60px" src="{{ asset('uploads/anhphim/' . $item->hinhanh) }}"
                                                alt=""></td>
                                        <td>
                                            <div class="row" style="margin-bottom: 5px;">
                                                <span>{{ $item->tieude }} &nbsp</span>
                                                <span class="badge badge-warning">[{{ $item->namphim }}]</span>
                                            </div>
                                            <div class="row" style="margin-bottom: 5px;">
                                                <span class="badge badge-primary" style="margin-right: 5px;">{{ $item->sotap }} Tập </span>
                                                @if ($item->chatluong == 0)
                                                <span class="badge badge-info" style="margin-right: 5px;">HD</span>
                                                
                                                @elseif($item->chatluong == 1)
                                                <span class="badge badge-info" style="margin-right: 5px;">2K</span>
                                                
                                                @elseif($item->chatluong == 2)
                                                <span class="badge badge-info" style="margin-right: 5px;">4K</span>
                                                
                                                @endif
                                                <span class="badge badge-secondary" style="margin-right: 5px;">{{ $item->danhmuc->tieude }}</span>
                                                <span class="badge badge-secondary">{{ $item->thoiluong }} Phút</span>
                                            </div>
                                            <div class="row">
                                                @foreach ($item->phim_theloai as $item1)
                                                <span class="badge badge-success" style="margin-right: 5px;">{{ $item1->tieude }}</span>
                                            @endforeach

                                            </div>
                                        
                                        </td>
                                        {{-- <td>{{ $item->sotap }}</td>
                                        <td>
                                            @if ($item->chatluong == 0)
                                                HD
                                            @elseif($item->chatluong == 1)
                                                2K
                                            @elseif($item->chatluong == 2)
                                                4K
                                            @endif
                                        </td>
                                        <td>{{ $item->namphim }}</td>
                                        <td>{{ $item->thoiluong }}</td>
                                        <td>{{ $item->danhmuc->tieude }}</td>
                                        <td>
                                            @foreach ($item->phim_theloai as $item1)
                                                {{ $item1->tieude }}<br>
                                            @endforeach
                                        </td> --}}
                                        <td>{{ $item->quocgia->tieude }}</td>
                                        <td>
                                            @if ($item->trangthai == 0)
                                                <span class="badge badge-danger">Không hiển thị</span>
                                            @else
                                                <span class="badge badge-success">Hiển thị</span>
                                                
                                            @endif
                                        </td>
                                        <td>
                                            <div class="row" style="display: flex; justify-content: space-evenly;">

                                                {!! Form::open([
                                                    'method' => 'DELETE',
                                                    'route' => ['phim.destroy', $item->id],
                                                    'id' => 'phim' . $item->id,
                                                    'data-id' => $item->id,
                                                    'class' => 'form-horizontal deletephim',
                                                ]) !!}
                                                {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                                <a href="{{ route('phim.edit', $item->id) }}"
                                                    class="btn btn-warning">Sửa</a>
                                                <a href="{{ route('them-tap-phim', [$item->id]) }}"
                                                    class="btn btn-success">Thêm tập phim</a>
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
