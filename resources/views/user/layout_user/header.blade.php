<header class="header" data-header>
    <div class="container" style="max-width: 85%">

      <div class="overlay" data-overlay></div>

      <a href="{{route('trangchu')}}" class="logo">
        <img src="/assets/images/logotrung.png" style="width: 75px; height:75px" alt="Filmlane logo">
      </a>

      <div class="header-actions">

        <button class="search-btn">
          <ion-icon name="search-outline"></ion-icon>
        </button>

        {{-- <button class="btn btn-primary">Sign in</button> --}}
        <div class="dropdown">
          <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            {{$user->name}}
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
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
            <img src="/assets/images/logo.svg" alt="Filmlane logo">
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

          <li>
            <a href="/index.html" class="navbar-link">Lọc Phim</a>
          </li>
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
  </header>