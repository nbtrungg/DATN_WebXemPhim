@extends('user.index')
@section('content')
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
            <h1 class="h1 detail-title">
               {{$chitietphim->tieude}}
               {{-- <strong>Guy</strong> --}}
            </h1>
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
       {{-- <iframe  width="100%" height="700" src="https://www.youtube.com/embed/EBU0K74TC-k" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe> --}}
         
         <video width="100%" height="600" controls>
            <source src="{{asset('/uploads/phim/'.$tapphim->linkphim)}}">
          </video>
         
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
 <section class="tv-series">
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
 </section>
    
@endsection