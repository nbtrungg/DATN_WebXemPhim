@extends('user.index')
@section('content')
<style>
   .page-link{
      background: #110f1a;
      color: yellow;
   }
   .page-item.active .page-link{
      background: yellow;
      color: #110f1a;
      border-color:white black;
   }
    .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
        color: #fff;
        background-color: #e2d703;
    }
</style>
<section class="top-rated">
    <div class="container" style="margin-top: 80px">
        <h2 class="h2 section-title" style="margin-bottom: 10px;">Lịch Sử Xem Phim</h2>
      <p class="section-subtitle" style="margin-bottom: 50px;">Danh Sách Những Bộ Phim Bạn Đã Xem</p>

       <ul class=" nav nav-pills mb-3 filter-list" id="pills-tab" role="tablist">
         <li class="nav-item">
           <a class="nav-link active filter-btn" id="pills-home-tab" data-toggle="pill" href="#sao" role="tab" aria-controls="pills-home" aria-selected="true">Hôm Nay</a>
         </li>
         <li class="nav-item">
           <a class="nav-link filter-btn" id="pills-profile-tab" data-toggle="pill" href="#binhluan1" role="tab" aria-controls="pills-profile" aria-selected="false">Tuần</a>
         </li>
         <li class="nav-item">
           <a class="nav-link filter-btn" id="pills-contact-tab" data-toggle="pill" href="#yeuthich" role="tab" aria-controls="pills-contact" aria-selected="false">Tháng</a>
         </li>
       </ul>
       {{-- <div class="tab-content" id="pills-tabContent">
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
                           <data>{{round($item->tbdanhgia)}}</data>
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
       </div> --}}
    </div>
 </section>
      
@endsection