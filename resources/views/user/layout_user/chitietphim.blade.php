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
<!-- 
   - #MOVIE DETAIL
   -->
   <section class="movie-detail">
    <div class="container">
       <figure class="movie-detail-banner">
          <img style="width: 300px" src="{{asset('/uploads/anhphim/'.$chitietphim->hinhanh)}}" alt="{{$chitietphim->tieude}}">
          @if (isset($tapphim_1->tap))
            <a class="play-btn" href="{{url('xem-phim/'.$chitietphim->slug.'/tap-'.$tapphim_1->tap)}}">
               <ion-icon name="play-circle-outline"></ion-icon>
            </a>             
          @endif
       </figure>
       <div class="movie-detail-content">
          {{-- <p class="detail-subtitle">New Episodes</p> --}}
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
<style>
   /* body{margin-top:20px;} */

   .content-item {
      padding:30px 0;
      background-color:#FFFFFF;
   }

   .content-item.grey {
      background-color:#F0F0F0;
      padding:50px 0;
      height:100%;
   }

   .content-item h2 {
      font-weight:700;
      font-size:35px;
      line-height:45px;
      text-transform:uppercase;
      margin:20px 0;
   }

   .content-item h3 {
      font-weight:400;
      font-size:20px;
      color:#555555;
      margin:10px 0 15px;
      padding:0;
   }

   .content-headline {
      height:1px;
      text-align:center;
      margin:20px 0 70px;
   }

   .content-headline h2 {
      background-color:#FFFFFF;
      display:inline-block;
      margin:-20px auto 0;
      padding:0 20px;
   }

   .grey .content-headline h2 {
      background-color:#F0F0F0;
   }

   .content-headline h3 {
      font-size:14px;
      color:#AAAAAA;
      display:block;
   }


   #comments {
      box-shadow: 0 -1px 6px 1px rgba(0,0,0,0.1);
      background-color:#FFFFFF;
   }

   #comments form {
      margin-bottom:30px;
   }

   #comments .btn {
      margin-top:7px;
   }

   #comments form fieldset {
      clear:both;
   }

   #comments form textarea {
      height:100px;
   }

   #comments .media {
      border-top:1px dashed #DDDDDD;
      padding:20px 0;
      margin:0;
   }

   #comments .media > .pull-left {
      margin-right:20px;
   }

   #comments .media img {
      max-width:100px;
   }

   #comments .media h4 {
      margin:0 0 10px;
   }

   #comments .media h4 span {
      font-size:14px;
      float:right;
      color:#999999;
   }

   #comments .media p {
      margin-bottom:15px;
      text-align:justify;
   }

   #comments .media-detail {
      margin:0;
   }

   #comments .media-detail li {
      color:#AAAAAA;
      font-size:12px;
      padding-right: 10px;
      font-weight:600;
   }

   #comments .media-detail a:hover {
      text-decoration:underline;
   }

   #comments .media-detail li:last-child {
      padding-right:0;
   }

   #comments .media-detail li i {
      color:#666666;
      font-size:15px;
      margin-right:10px;
   }

   .binhluan:hover{
      border: 2px solid #e2d703 !important;
      color: white !important;
   }
</style>
{{-- bình luận --}}
<section style="background: #e2d703;" class="content-item" id="comments">
   <div class="container">   
      <div class="flex-wrapper">
         <div class="title-wrapper">
            <p style="color: black" class="section-subtitle">Bạn Có Thể Đánh Giá Phim Ở Đây</p>
            <h2 class="h2 section-title">Bình Luận</h2>
         </div>
      </div>
      <div class="">
           <div class="col-sm-12">   
               <form action="" method="POST">
                  <h3  class="pull-left">{{$user->name}}</h3>
                  <input type="hidden" id="tenbinhluan" value="{{$user->name}}">
                   <fieldset>
                       <div class="row">
                           {{-- <div class="col-sm-3 col-lg-2 hidden-xs">
                              <img class="img-responsive" src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                           </div> --}}
                           <div class="form-group">
                               <textarea class="form-control" id="binhluan-content" placeholder="Viết bình luận của bạn" required=""></textarea>
                               <input type="hidden" id="phim_id" value="{{$chitietphim->id}}">
                               <input type="hidden" id="user_id" value="{{$user->id}}">

                           </div>
                           <div style="float: right;" class="form-group">
                              <button style="color: #e2d703; background:#242c38 ; border: 2px solid black" id="binhluan" type="button" class="binhluan btn btn-normal pull-right">Thêm Bình Luận</button>
                          </div>
                       </div>  	
                   </fieldset>
                  @csrf
               </form>
               
               <h3>{{$tongbinhluan}} Bình luận</h3>
               
               <!-- COMMENT 1 - START -->
               <div id="hienbinhluan">
                  @foreach ($binhluan as $key => $item)
                      
                  <div class="media">
                     {{-- <a class="pull-left" href="#"><img class="media-object" src="https://bootdey.com/img/Content/avatar/avatar1.png" alt=""></a> --}}
                     <div class="media-body">
                         <h4 class="media-heading">{{$item->user->name}}</h4>
                         <p>{{$item->noidung}}</p>
                         <ul class="list-unstyled list-inline media-detail pull-left">
                             <li style="color: black"><i style="color: black" class="fa fa-calendar"></i>{{$item->created_at->format('d-m-Y')}}</li>
                         </ul>
                     </div>
                 </div>
                 <!-- COMMENT 1 - END -->
                  @endforeach
               </div>
               <div style="display: flex; justify-content: space-evenly; margin-top:50px">
                  {{$binhluan->links("pagination::bootstrap-4")}}
                </div>
               
               
           </div>
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