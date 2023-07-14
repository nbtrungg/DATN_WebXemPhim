@extends('user.index')
@section('content')

<!-- 
   - #HERO
   -->
   <style>
      .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
         color: #fff;
         background-color: #e2d703;
      }
   </style>
   <section class="hero">
    <div class="container">
       <div class="hero-content">
          <p class="hero-subtitle">Trang Chủ</p>
          <h1 class="h1 hero-title">
             Xem <strong>Phim</strong> Không Giới Hạn.
          </h1>
          {{-- <div class="meta-wrapper">
             <div class="badge-wrapper">
                <div class="badge badge-fill">PG 18</div>
                <div class="badge badge-outline">HD</div>
             </div>
             <div class="ganre-wrapper">
                <a href="#">Romance,</a>
                <a href="#">Drama</a>
             </div>
             <div class="date-time">
                <div>
                   <ion-icon name="calendar-outline"></ion-icon>
                   <time datetime="2022">2022</time>
                </div>
                <div>
                   <ion-icon name="time-outline"></ion-icon>
                   <time datetime="PT128M">128 min</time>
                </div>
             </div>
          </div>
          <button class="btn btn-primary">
             <ion-icon name="play"></ion-icon>
             <span>Watch now</span>
          </button> --}}
       </div>
    </div>
 </section>

{{-- Phim User Thích xem khi đăng kí --}}
@if(!empty($phim_user_theloai)&&$phim_user_theloai->count()>0)
<section class="upcoming">
   <div class="container">
      <div class="flex-wrapper">
         <div class="title-wrapper">
            <p class="section-subtitle">Sở Thích</p>
            <h2 class="h2 section-title">Các Thể Loại Mà Bạn Thích</h2>
         </div>
      </div>
      <ul class="movies-list  has-scrollbar">

        @foreach ($phim_user_theloai as $key => $item)
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
@endif
{{-- Phim User xem khi đánh giá --}}
@if(!empty($phimdexuat_sao)&&$phimdexuat_sao->count()>0)
<section class="upcoming">
   <div class="container">
      <div class="flex-wrapper">
         <div class="title-wrapper">
            <p class="section-subtitle">Đánh Giá Cao</p>
            <h2 class="h2 section-title">Dựa Trên Đánh Giá Của Bạn</h2>
            {{-- <a href="{{route('thuattoan')}}" target="_blank" rel="noopener noreferrer">Xem thuật toán</a> --}}
         </div>
      </div>
      <ul class="movies-list  has-scrollbar">

        @foreach ($phimdexuat_sao as $key => $item)
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
@endif
 <!-- 
    - #UPCOMING
   -->
   @if(!empty($recommendations))
 <section class="upcoming">
    <div class="container">
       <div class="flex-wrapper">
          <div class="title-wrapper">
             <p class="section-subtitle">Phim Phù Hợp</p>
             <h2 class="h2 section-title">Tương Tự Các Phim Bạn Đã Xem</h2>
          </div>
       </div>
       <ul class="movies-list  has-scrollbar">
         @foreach ($recommendations as $key => $item)
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
@endif

 
 <!-- 
    - #TOP RATED
    -->
 <section class="top-rated">
    <div class="container">
       <p class="section-subtitle">Bảng Xếp Hạng</p>
       <h2 class="h2 section-title">Top Phim</h2>

       <ul class=" nav nav-pills mb-3 filter-list" id="pills-tab" role="tablist">
         <li class="nav-item">
           <a class="nav-link active filter-btn" id="pills-home-tab" data-toggle="pill" href="#sao" role="tab" aria-controls="pills-home" aria-selected="true">Top Sao</a>
         </li>
         <li class="nav-item">
           <a class="nav-link filter-btn" id="pills-profile-tab" data-toggle="pill" href="#binhluan1" role="tab" aria-controls="pills-profile" aria-selected="false">Top Bình Luận</a>
         </li>
         <li class="nav-item">
           <a class="nav-link filter-btn" id="pills-contact-tab" data-toggle="pill" href="#yeuthich" role="tab" aria-controls="pills-contact" aria-selected="false">Top Yêu Thích</a>
         </li>
       </ul>
       <div class="tab-content" id="pills-tabContent">
         <div class="tab-pane fade show active" id="sao" role="tabpanel" aria-labelledby="pills-home-tab">
            <ul class="movies-list">
               @foreach ($phimtopsao as $key => $item)
                   
               <li>
                  <div class="movie-card">
                     <a href="{{route('chitietphim',$item->slug)}}">
                        <figure class="card-banner">
                           <img src="{{asset('uploads/anhphim/'.$item->hinhanh)}}" alt="{{$item->tieude}}">
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
         <div class="tab-pane fade" id="binhluan1" role="tabpanel" aria-labelledby="pills-profile-tab">
            <ul class="movies-list">
               @foreach ($phimtopbinhluan as $key => $item1)  
               <li>
                  <div class="movie-card">
                     <a href="{{route('chitietphim',$item1->slug)}}">
                        <figure class="card-banner">
                           <img src="{{asset('uploads/anhphim/'.$item1->hinhanh)}}" alt="{{$item1->tieude}}">
                        </figure>
                     </a>
                     <div class="title-wrapper">
                        <a href="{{route('chitietphim',$item1->slug)}}">
                           <h3 class="card-title">{{$item1->tieude}}</h3>
                        </a>
                        <time datetime="{{$item1->namphim}}">{{$item1->namphim}}</time>
                     </div>
                     <div class="card-meta">
                        <div class="badge badge-outline">
                          @if ($item1->chatluong==0)
                          HD
                       @elseif($item1->chatluong==1)
                          2K
                       @elseif($item1->chatluong==2)
                          4K
                       @endif
                        </div>
                        <div class="duration">
                           <ion-icon name="time-outline"></ion-icon>
                           <time datetime="PT{{$item1->thoiluong}}M">{{$item1->thoiluong}} min</time>
                        </div>
                        <div class="rating">
                           <ion-icon name="chatbubble-ellipses-outline"></ion-icon>
                           <data>{{round($item1->binhluan_count)}}</data>
                        </div>
                     </div>
                  </div>
               </li>
               @endforeach
            </ul>
         </div>
         <div class="tab-pane fade" id="yeuthich" role="tabpanel" aria-labelledby="pills-contact-tab">
            <ul class="movies-list">
               @foreach ($phimtopyeuthich as $key => $item)
                   
               <li>
                  <div class="movie-card">
                     <a href="{{route('chitietphim',$item->slug)}}">
                        <figure class="card-banner">
                           <img src="{{asset('uploads/anhphim/'.$item->hinhanh)}}" alt="{{$item->tieude}}">
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
                           <ion-icon name="heart-circle-outline"></ion-icon>
                           <data>{{round($item->yeuthich_count)}}</data>
                        </div>
                     </div>
                  </div>
               </li>
               @endforeach
            </ul>
         </div>
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
     
@endsection