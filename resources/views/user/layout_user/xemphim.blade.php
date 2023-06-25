@extends('user.index')
@section('content')
<style>
   .vjs-big-play-centered{
      width:100%;
      height:600px;
   }
</style>
<!-- 
   - #MOVIE DETAIL
   -->
   <section class="movie-detail">
      <div class="container">
         <figure class="movie-detail-banner">
            <img style="width: 300px" src="{{asset('/uploads/anhphim/'.$chitietphim->hinhanh)}}" alt="{{$chitietphim->tieude}}">
               {{-- <ion-icon name="play-circle-outline"></ion-icon> --}}
            </a>
         </figure>
         <div class="movie-detail-content">
            <p class="detail-subtitle">Bạn Đang Xem:</p>
            <a href="{{route('chitietphim',$chitietphim->slug)}}">

               <h1 class="h1 detail-title">
                  {{$chitietphim->tieude}}
                  {{-- <strong>Guy</strong> --}}
               </h1>
            </a>
            <div class="meta-wrapper">
               <div class="badge-wrapper">
                  {{-- <div class="badge badge-fill">PG 13</div> --}}
                  <div class="badge badge-outline">
                    @if ($chitietphim->chatluong==0)
                       HD
                    @elseif($chitietphim->chatluong==1)
                       2K
                    @elseif($chitietphim->chatluong==2)
                       4K
                    @endif
                 </div>
               </div>
               
               <div class="date-time">
                  <div>
                     <ion-icon name="calendar-outline"></ion-icon>
                     <time datetime="{{$chitietphim->namphim}}">{{$chitietphim->namphim}}</time>
                  </div>
                  <div>
                     <ion-icon name="time-outline"></ion-icon>
                     <time datetime="P{{$chitietphim->thoiluong}}TM">{{$chitietphim->thoiluong}} min</time>
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
              @foreach ($chitietphim->phim_theloai as $item)
              <a href="{{route('theloai',$item->slug)}}">{{$item->tieude}}</a>   
              @endforeach
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
            {{-- <div class="details-actions">
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
            </div> --}}
            {{-- <a href="/assets/images/movie-4.png" download class="download-btn">
               <span>Download</span>
               <ion-icon name="download-outline"></ion-icon>
            </a> --}}
         </div>
      </div>
   </section>

 <!-- 
   - #XEM PHIM
   -->
<section class="top-rated">
    <div class="container">
       <!-- <iframe width="100%" height="600" src="https://youtu.be/EBU0K74TC-k" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
       {{-- <iframe  width="100%" height="700" src="https://www.youtube.com/embed/EBU0K74TC-k?start=90" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe> --}}
         
         {{-- <video width="100%" height="600" controls>
            <source src="{{asset('/uploads/phim/'.$tapphim->linkphim)}}">
          </video> --}}
          {{-- <iframe id="myVideo" src="https://kd.hd-bophim.com/share/4f47f68c8ad4792d404d2ff5e57c97ba?start=150" width="100%" height="600" frameborder="0" allow="autostop" allowfullscreen></iframe> --}}
          
         <video id="my-video" data-id="{{$tapphim->id}}" @if(!empty($tientrinh)) data-tientrinh="{{$tientrinh->thoigian}}" @else data-tientrinh="0" @endif class="video-js vjs-big-play-centered" controls preload="auto">
            <source src="{{$tapphim->linkphim}}" type="application/x-mpegURL">
         </video>
         <!-- Đường dẫn đến thư viện Video.js -->
         <script src="https://vjs.zencdn.net/7.15.4/video.min.js"></script>
         <script>
            // Khởi tạo video player
            var player = videojs('my-video');
            var video = document.getElementsByTagName('video')[0];
            var tientrinh = video.getAttribute('data-tientrinh');
            video.addEventListener('loadedmetadata', function() {
               video.currentTime = tientrinh;
               video.play();
               // video.addEventListener('timeupdate', function() {
               // var currentTime = this.currentTime;
               // var tapphim_id=$('#my-video').data("id");

               // console.log(tapphim_id);
               // // Lưu currentTime vào cơ sở dữ liệu


            // });
         });
         </script>
        
      </div>
      
    <div class="container" style="margin-top: 20px;">
       <div>
          <h5 style="color: white;">Tập Phim:</h5>
       </div>
       <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
         @foreach ($chitietphim->tapphim as $key=>$item)
         <div style="margin: 5px;" class="btn-group mr-2" role="group" aria-label="First group">
             <a href="{{url('xem-phim/'.$chitietphim->slug.'/tap-'.$item->tap)}}" type="button" class="btn btn-secondary taphover {{$sotapphim==$item->tap ? 'active' : ''}}">{{$key+1}}</a>
         </div>
         @endforeach
            
          
       </div>
    </div>
 </section>
 <!-- 
    - #TV SERIES
    -->
 {{-- <section class="tv-series">
    <div class="container">
       <p class="section-subtitle">Best TV Series</p>
       <h2 class="h2 section-title">World Best TV Series</h2>
       <ul class="movies-list">
          <li>
             <div class="movie-card">
                <a href="/movie-details.html">
                   <figure class="card-banner">
                      <img src="/assets/images/series-1.png" alt="Moon Knight movie poster">
                   </figure>
                </a>
                <div class="title-wrapper">
                   <a href="/movie-details.html">
                      <h3 class="card-title">Moon Knight</h3>
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
          <li>
             <div class="movie-card">
                <a href="/movie-details.html">
                   <figure class="card-banner">
                      <img src="/assets/images/series-2.png" alt="Halo movie poster">
                   </figure>
                </a>
                <div class="title-wrapper">
                   <a href="/movie-details.html">
                      <h3 class="card-title">Halo</h3>
                   </a>
                   <time datetime="2022">2022</time>
                </div>
                <div class="card-meta">
                   <div class="badge badge-outline">2K</div>
                   <div class="duration">
                      <ion-icon name="time-outline"></ion-icon>
                      <time datetime="PT59M">59 min</time>
                   </div>
                   <div class="rating">
                      <ion-icon name="star"></ion-icon>
                      <data>8.8</data>
                   </div>
                </div>
             </div>
          </li>
          <li>
             <div class="movie-card">
                <a href="/movie-details.html">
                   <figure class="card-banner">
                      <img src="/assets/images/series-3.png" alt="Vikings: Valhalla movie poster">
                   </figure>
                </a>
                <div class="title-wrapper">
                   <a href="/movie-details.html">
                      <h3 class="card-title">Vikings: Valhalla</h3>
                   </a>
                   <time datetime="2022">2022</time>
                </div>
                <div class="card-meta">
                   <div class="badge badge-outline">2K</div>
                   <div class="duration">
                      <ion-icon name="time-outline"></ion-icon>
                      <time datetime="PT51M">51 min</time>
                   </div>
                   <div class="rating">
                      <ion-icon name="star"></ion-icon>
                      <data>8.3</data>
                   </div>
                </div>
             </div>
          </li>
          <li>
             <div class="movie-card">
                <a href="/movie-details.html">
                   <figure class="card-banner">
                      <img src="/assets/images/series-4.png" alt="Money Heist movie poster">
                   </figure>
                </a>
                <div class="title-wrapper">
                   <a href="/movie-details.html">
                      <h3 class="card-title">Money Heist</h3>
                   </a>
                   <time datetime="2017">2017</time>
                </div>
                <div class="card-meta">
                   <div class="badge badge-outline">4K</div>
                   <div class="duration">
                      <ion-icon name="time-outline"></ion-icon>
                      <time datetime="PT70M">70 min</time>
                   </div>
                   <div class="rating">
                      <ion-icon name="star"></ion-icon>
                      <data>8.3</data>
                   </div>
                </div>
             </div>
          </li>
       </ul>
    </div>
 </section> --}}
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
                  <time datetime="{{$item->namphim}}">{{$item->namphim}}</time>
                 </div>
               <div class="card-meta">
                 <div class="badge badge-outline">
                    @if ($item->chatluong==0)
                    HD
                 @elseif($item->chatluong==1)
                    2K
                 @elseif($item->chatluong==2)
                    4K
                 @endif
                  </div>
                 <div class="duration">
                     <ion-icon name="time-outline"></ion-icon>
                     <time datetime="PT{{$item->thoiluong}}M">{{$item->thoiluong}} min</time>
                    </div>
                  <div class="rating">
                     <ion-icon name="star"></ion-icon>
                     <data>{{$item->tbdanhgia}}</data>
                  </div>
               </div>
            </div>
         </li>
         @endforeach
      </ul>
   </div>
</section>
    
@endsection

@section('luutientrinh')
<script src="\assets\js\luutientrinh.js"></script>
@endsection