@extends('user.index')
@section('content')
<!-- 
   - #MOVIE DETAIL
   -->
   <section class="movie-detail">
    <div class="container">
       <figure class="movie-detail-banner">
          <img src="/assets/images/movie-4.png" alt="Free guy movie poster">
          <button class="play-btn">
             <ion-icon name="play-circle-outline"></ion-icon>
          </button>
       </figure>
       <div class="movie-detail-content">
          <p class="detail-subtitle">New Episodes</p>
          <h1 class="h1 detail-title">
             Free <strong>Guy</strong>
          </h1>
          <div class="meta-wrapper">
             <div class="badge-wrapper">
                <div class="badge badge-fill">PG 13</div>
                <div class="badge badge-outline">HD</div>
             </div>
             <div class="ganre-wrapper">
                <a href="#">Comedy,</a>
                <a href="#">Action,</a>
                <a href="#">Adventure,</a>
                <a href="#">Science Fiction</a>
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
          <p class="storyline">
             A bank teller called Guy realizes he is a background character in an open world video game called Free
             City that will
             soon go offline.
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
   - #XEM PHIM
   -->
<section class="top-rated">
    <div class="container">
       <!-- <iframe width="100%" height="600" src="https://youtu.be/EBU0K74TC-k" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
       <iframe  width="100%" height="700" src="https://www.youtube.com/embed/EBU0K74TC-k" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    </div>
    <div class="container" style="margin-top: 20px;">
       <div>
          <h5 style="color: white;">Tập Phim:</h5>
       </div>
       <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
            <div style="margin: 5px;" class="btn-group mr-2" role="group" aria-label="First group">
                <a href="{{route('tapphim')}}" type="button" class="btn btn-secondary">1</a>
            </div>
            <div style="margin: 5px;" class="btn-group mr-2" role="group" aria-label="First group">
                <a href="{{route('tapphim')}}" type="button" class="btn btn-secondary">2</a>
            </div>
          
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