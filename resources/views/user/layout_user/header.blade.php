<style>
  .input--file {
  position: relative;
  color: white;
}

.input--file input[type="file"] {
  position: absolute;
  top: 0;
  left: 0;
  opacity: 0;
}
</style>
<header class="header" data-header>
    <div class="container" style="max-width: 85%">

      <div class="overlay" data-overlay></div>

      <a href="{{route('trangchu')}}" class="logo">
        <img src="/assets/images/logotrung.png" style="width: 75px; height:75px" alt="Filmlane logo">
      </a>

      <div class="header-actions">
        <div class="">
          <form action="{{route('timkiem')}}" method="GET">
          <input type="text" style="max-width: 200px;" name="search" id="timkiem" class="form-control">
          <ul class="form-control" id="result" style="max-width: 200px; display:none;">
          </ul>
        </div>
        <button class="search-btn">
          <ion-icon name="search-outline"></ion-icon>
        </button>
        {{-- @csrf --}}
      </form>

        <div class="">
          <form id="formtimkiemanh" action="{{route('timkiemanh')}}" method="POST" enctype="multipart/form-data">
          {{-- <input type="file" style="max-width: 200px;" name="searchanh" id="timkiemanh" class="form-control"> --}}
          <div class="input--file">
              <ion-icon name="image-sharp"></ion-icon>
            <input id="timkiemanh" name="searchanh" type="file" accept="image/*" multiple/>
          </div>
        </div>
        @csrf
      </form>
      <script>
          const inputFile = document.getElementById('timkiemanh');
          const form = document.getElementById('formtimkiemanh');

          inputFile.addEventListener('change', function() {
            form.submit();
          });
      </script>

        
        {{-- <button class="btn btn-primary">Sign in</button> --}}
        <div class="dropdown">
          <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            {{$user->name}}
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="{{route('lichsuxemphim')}}">Lịch Sử Xem Phim</a></li>
            <li><a class="dropdown-item" href="{{route('danhsachyeuthich')}}">Danh Sách Yêu Thích</a></li>
            <li><a class="dropdown-item" href="{{route('logout_user')}}">Đăng Xuất</a></li>
          </ul>
        </div>

      </div>

      <button class="menu-open-btn" data-menu-open-btn>
        <ion-icon name="reorder-two"></ion-icon>
      </button>

      <nav class="navbar" data-navbar>

        <div class="navbar-top">

          <a href="/index.html" class="logo">
            <img src="/assets/images/logotrung.png" style="width: 75px; height:75px" alt="Filmlane logo">
          </a>

          <button class="menu-close-btn" data-menu-close-btn>
            <ion-icon name="close-outline"></ion-icon>
          </button>

        </div>

        <ul class="navbar-list">

          <li>
            <a href="{{route('trangchu')}}" class="navbar-link">Trang Chủ</a>
          </li>
          @foreach ($danhmuc as $key=>$item)
          <li>
            <a href="{{route('danhmuc',$item->slug)}}" class="navbar-link">{{$item->tieude}}</a>
          </li>              
          @endforeach

          {{-- <li>
            <div class="dropdown">
              <a href="#" class="navbar-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">Năm</a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Action</a>
                
              </div>
            </div>
          </li> --}}

          <li>
            <div class="dropdown">
              <a href="#" class="navbar-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">Thể Loại</a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @foreach ($theloai as $key => $item)
                <a class="dropdown-item" href="{{route('theloai',$item->slug)}}">{{$item->tieude}}</a>                    
                @endforeach
              </div>
            </div>
          </li>

          <li>
            {{-- <a href="#" class="navbar-link">Pricing</a> --}}
            <div class="dropdown">
              <a href="#" class="navbar-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">Quốc Gia</a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @foreach ($quocgia as $key => $item)
                <a class="dropdown-item" href="{{route('quocgia',$item->slug)}}">{{$item->tieude}}</a>                   
                @endforeach
              </div>
            </div>
          </li>

          {{-- <li>
            <a href="/index.html" class="navbar-link">Phim Lẻ</a>
          </li>

          <li>
            <a href="/index.html" class="navbar-link">Phim Bộ</a>
          </li> --}}

          {{-- <li>
            <a href="/index.html" class="navbar-link">Lọc Phim</a>
          </li> --}}
        </ul>

        <ul class="navbar-social-list">

          <li>
            <a href="#" class="navbar-social-link">
              <ion-icon name="logo-twitter"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="navbar-social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="navbar-social-link">
              <ion-icon name="logo-pinterest"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="navbar-social-link">
              <ion-icon name="logo-instagram"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="navbar-social-link">
              <ion-icon name="logo-youtube"></ion-icon>
            </a>
          </li>

        </ul>

      </nav>

    </div>
    <style>
      a:hover{
        color: hsl(57.04deg 97.38% 44.9%);
      }
      .taphover:hover{
        color: black !important;
        background: hsl(57.04deg 97.38% 44.9%) !important;
      }
      .btn-secondary.active{
        color: #000000;
        background-color: hsl(57.04deg 97.38% 44.9%);
        border-color: #fbff00;
      }
    </style>
  </header>