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
</style>
<section class="top-rated">
    <div class="container" style="margin-top: 30px">
      <h2 class="h2 section-title" style="margin-bottom: 10px;">{{$quocgia_slug->tieude}}</h2>
      <p class="section-subtitle" style="margin-bottom: 50px;">{{$quocgia_slug->mota}}</p>
       <ul class="movies-list">
          @foreach ($phim as $key=>$item)

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
       <div style="display: flex; justify-content: space-evenly; margin-top:50px">
         {{$phim->links("pagination::bootstrap-4")}}
       </div>
    </div>
 </section>
      
@endsection