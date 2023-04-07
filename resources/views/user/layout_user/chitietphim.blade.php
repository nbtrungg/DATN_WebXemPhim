@extends('user.index')
@section('content')
<!-- 
   - #MOVIE DETAIL
   -->
   <section class="movie-detail">
    <div class="container">
       <figure class="movie-detail-banner">
          <img style="width: 300px" src="{{asset('/uploads/anhphim/'.$chitietphim->hinhanh)}}" alt="{{$chitietphim->tieude}}">
          <a class="play-btn" href="{{route('xemphim')}}">
             <ion-icon name="play-circle-outline"></ion-icon>
          </a>
       </figure>
       <div class="movie-detail-content">
          {{-- <p class="detail-subtitle">New Episodes</p> --}}
          <h1 class="h1 detail-title">
             {{$chitietphim->tieude}}
             {{-- <strong>Guy</strong> --}}
          </h1>
          <div class="meta-wrapper">
             <div class="badge-wrapper">
                <div class="badge badge-fill">PG 13</div>
                <div class="badge badge-outline">HD</div>
             </div>
             
             <div class="date-time">
                <div>
                   <ion-icon name="calendar-outline"></ion-icon>
                   <time datetime="2021">2021</time>
                </div>
                <div>
                   <ion-icon name="time-outline"></ion-icon>
                   <time datetime="PT115M">115 min</time>
                </div>
             </div>
          </div>
          <div style=" margin-bottom: 5px;" class="ganre-wrapper">
            <span style="color: yellow">Danh Mục: </span>
            <a href="{{route('danhmuc',$chitietphim->danhmuc->slug)}}">{{$chitietphim->danhmuc->tieude}}</a>
            {{-- <a href="#">Action,</a>
            <a href="#">Adventure,</a>
            <a href="#">Science Fiction</a> --}}
         </div>
         <div style=" margin-bottom: 5px;" class="ganre-wrapper">
            <span style="color: yellow">Thể Loại: </span>
            <a href="{{route('theloai',$chitietphim->theloai->slug)}}">{{$chitietphim->theloai->tieude}}</a>
            {{-- <a href="#">Action,</a>
            <a href="#">Adventure,</a>
            <a href="#">Science Fiction</a> --}}
         </div>
         <div style=" margin-bottom: 25px;" class="ganre-wrapper">
            <span style="color: yellow">Quốc Gia: </span>
            <a href="{{route('quocgia',$chitietphim->quocgia->slug)}}">{{$chitietphim->quocgia->tieude}}</a>
            {{-- <a href="#">Action,</a>
            <a href="#">Adventure,</a>
            <a href="#">Science Fiction</a> --}}
         </div>
          <p class="storyline">
             {{$chitietphim->mota}}
          </p>
          <div class="details-actions">
             <button class="share">
                <ion-icon name="share-social"></ion-icon>
                <span>Share</span>
             </button>
             <div class="title-wrapper">
                <p class="title">Prime Video</p>
                <p class="text">Streaming Channels</p>
             </div>
             <button class="btn btn-primary">
                <ion-icon name="play"></ion-icon>
                <span>Watch Now</span>
             </button>
          </div>
          <a href="/assets/images/movie-4.png" download class="download-btn">
             <span>Download</span>
             <ion-icon name="download-outline"></ion-icon>
          </a>
       </div>
    </div>
 </section>
 <!-- 
    - #TV SERIES
    -->
 <section class="upcoming">
    <div class="container">
       {{-- <p class="section-subtitle">Phim Liên Quan</p>
       <h2 class="h2 section-title">Có Thể Bạn Muốn Xem</h2> --}}
       <div class="flex-wrapper">
         <div class="title-wrapper">
            <p class="section-subtitle">Phim Liên Quan</p>
            <h2 class="h2 section-title">Có Thể Bạn Muốn Xem</h2>
         </div>
      </div>
       <ul class="movies-list has-scrollbar">
         @foreach ($phimlienquan as $key => $item)
          <li>
             <div class="movie-card">
                <a href="{{route('chitietphim',$item->slug)}}">
                   <figure class="card-banner">
                      <img src="{{asset('/uploads/anhphim/'.$item->hinhanh)}}" alt="{{$item->tieude}}">
                   </figure>
                </a>
                <div class="title-wrapper">
                   <a href="{{route('chitietphim',$item->slug)}}">
                      <h3 class="card-title">{{$item->tieude}}</h3>
                   </a>
                   <time datetime="2022">2022</time>
                </div>
                <div class="card-meta">
                   <div class="badge badge-outline">2K</div>
                   <div class="duration">
                      <ion-icon name="time-outline"></ion-icon>
                      <time datetime="PT47M">47 min</time>
                   </div>
                   <div class="rating">
                      <ion-icon name="star"></ion-icon>
                      <data>8.6</data>
                   </div>
                </div>
             </div>
          </li>
          @endforeach
       </ul>
    </div>
 </section>
    
@endsection