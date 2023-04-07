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
          <p class="hero-subtitle">Filmlane</p>
          <h1 class="h1 hero-title">
             Unlimited <strong>Movie</strong>, TVs Shows, & More.
          </h1>
          <div class="meta-wrapper">
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
          </button>
       </div>
    </div>
 </section>
 <!-- 
    - #UPCOMING
    -->
 <section class="upcoming">
    <div class="container">
       <div class="flex-wrapper">
          <div class="title-wrapper">
             <p class="section-subtitle">Online Streaming</p>
             <h2 class="h2 section-title">Upcoming Movies</h2>
          </div>
       </div>
       <ul class="movies-list  has-scrollbar">
          <li>
             <div class="movie-card">
                <a href="">
                   <figure class="card-banner">
                      <img src="/assets/images/upcoming-1.png" alt="The Northman movie poster">
                   </figure>
                </a>
                <div class="title-wrapper">
                   <a href="/movie-details.html">
                      <h3 class="card-title">The Northman</h3>
                   </a>
                   <time datetime="2022">2022</time>
                </div>
                <div class="card-meta">
                   <div class="badge badge-outline">HD</div>
                   <div class="duration">
                      <ion-icon name="time-outline"></ion-icon>
                      <time datetime="PT137M">137 min</time>
                   </div>
                   <div class="rating">
                      <ion-icon name="star"></ion-icon>
                      <data>8.5</data>
                   </div>
                </div>
             </div>
          </li>
          <li>
            <div class="movie-card">
               <a href="">
                  <figure class="card-banner">
                     <img src="/assets/images/upcoming-1.png" alt="The Northman movie poster">
                  </figure>
               </a>
               <div class="title-wrapper">
                  <a href="/movie-details.html">
                     <h3 class="card-title">The Northman</h3>
                  </a>
                  <time datetime="2022">2022</time>
               </div>
               <div class="card-meta">
                  <div class="badge badge-outline">HD</div>
                  <div class="duration">
                     <ion-icon name="time-outline"></ion-icon>
                     <time datetime="PT137M">137 min</time>
                  </div>
                  <div class="rating">
                     <ion-icon name="star"></ion-icon>
                     <data>8.5</data>
                  </div>
               </div>
            </div>
         </li>
         <li>
             <div class="movie-card">
                <a href="">
                   <figure class="card-banner">
                      <img src="/assets/images/upcoming-1.png" alt="The Northman movie poster">
                   </figure>
                </a>
                <div class="title-wrapper">
                   <a href="/movie-details.html">
                      <h3 class="card-title">The Northman</h3>
                   </a>
                   <time datetime="2022">2022</time>
                </div>
                <div class="card-meta">
                   <div class="badge badge-outline">HD</div>
                   <div class="duration">
                      <ion-icon name="time-outline"></ion-icon>
                      <time datetime="PT137M">137 min</time>
                   </div>
                   <div class="rating">
                      <ion-icon name="star"></ion-icon>
                      <data>8.5</data>
                   </div>
                </div>
             </div>
          </li>
          <li>
             <div class="movie-card">
                <a href="">
                   <figure class="card-banner">
                      <img src="/assets/images/upcoming-1.png" alt="The Northman movie poster">
                   </figure>
                </a>
                <div class="title-wrapper">
                   <a href="/movie-details.html">
                      <h3 class="card-title">The Northman</h3>
                   </a>
                   <time datetime="2022">2022</time>
                </div>
                <div class="card-meta">
                   <div class="badge badge-outline">HD</div>
                   <div class="duration">
                      <ion-icon name="time-outline"></ion-icon>
                      <time datetime="PT137M">137 min</time>
                   </div>
                   <div class="rating">
                      <ion-icon name="star"></ion-icon>
                      <data>8.5</data>
                   </div>
                </div>
             </div>
          </li>
          <li>
             <div class="movie-card">
                <a href="/movie-details.html">
                   <figure class="card-banner">
                      <img src="/assets/images/upcoming-2.png"
                         alt="Doctor Strange in the Multiverse of Madness movie poster">
                   </figure>
                </a>
                <div class="title-wrapper">
                   <a href="/movie-details.html">
                      <h3 class="card-title">Doctor Strange in the Multiverse of Madness</h3>
                   </a>
                   <time datetime="2022">2022</time>
                </div>
                <div class="card-meta">
                   <div class="badge badge-outline">4K</div>
                   <div class="duration">
                      <ion-icon name="time-outline"></ion-icon>
                      <time datetime="PT126M">126 min</time>
                   </div>
                   <div class="rating">
                      <ion-icon name="star"></ion-icon>
                      <data>NR</data>
                   </div>
                </div>
             </div>
          </li>
          <li>
             <div class="movie-card">
                <a href="/movie-details.html">
                   <figure class="card-banner">
                      <img src="/assets/images/upcoming-3.png" alt="Memory movie poster">
                   </figure>
                </a>
                <div class="title-wrapper">
                   <a href="/movie-details.html">
                      <h3 class="card-title">Memory</h3>
                   </a>
                   <time datetime="2022">2022</time>
                </div>
                <div class="card-meta">
                   <div class="badge badge-outline">2K</div>
                   <div class="duration">
                      <ion-icon name="time-outline"></ion-icon>
                      <time datetime="">N/A</time>
                   </div>
                   <div class="rating">
                      <ion-icon name="star"></ion-icon>
                      <data>NR</data>
                   </div>
                </div>
             </div>
          </li>
          <li>
             <div class="movie-card">
                <a href="/movie-details.html">
                   <figure class="card-banner">
                      <img src="/assets/images/upcoming-4.png"
                         alt="The Unbearable Weight of Massive Talent movie poster">
                   </figure>
                </a>
                <div class="title-wrapper">
                   <a href="/movie-details.html">
                      <h3 class="card-title">The Unbearable Weight of Massive Talent</h3>
                   </a>
                   <time datetime="2022">2022</time>
                </div>
                <div class="card-meta">
                   <div class="badge badge-outline">HD</div>
                   <div class="duration">
                      <ion-icon name="time-outline"></ion-icon>
                      <time datetime="PT107M">107 min</time>
                   </div>
                   <div class="rating">
                      <ion-icon name="star"></ion-icon>
                      <data>NR</data>
                   </div>
                </div>
             </div>
          </li>
       </ul>
    </div>
 </section>
 <!-- 
    - #TOP RATED
    -->
 <section class="top-rated">
    <div class="container">
       <p class="section-subtitle">Online Streaming</p>
       <h2 class="h2 section-title">Top Rated Movies</h2>
       {{-- <ul class="filter-list nav nav-pills mb-3" id="pills-tab" role="tablist">
          <li>
             <button class="filter-btn">Movies</button>
          </li>
          <li>
             <button class="filter-btn">TV Shows</button>
          </li>
          <li>
             <button class="filter-btn">Documentary</button>
          </li>
          <li>
             <button class="filter-btn">Sports</button>
          </li>
       </ul>
       <ul class="movies-list">
          <li>
             <div class="movie-card">
                <a href="/movie-details.html">
                   <figure class="card-banner">
                      <img src="/assets/images/movie-1.png" alt="Sonic the Hedgehog 2 movie poster">
                   </figure>
                </a>
                <div class="title-wrapper">
                   <a href="/movie-details.html">
                      <h3 class="card-title">Sonic the Hedgehog 2</h3>
                   </a>
                   <time datetime="2022">2022</time>
                </div>
                <div class="card-meta">
                   <div class="badge badge-outline">2K</div>
                   <div class="duration">
                      <ion-icon name="time-outline"></ion-icon>
                      <time datetime="PT122M">122 min</time>
                   </div>
                   <div class="rating">
                      <ion-icon name="star"></ion-icon>
                      <data>7.8</data>
                   </div>
                </div>
             </div>
          </li>
          <li>
             <div class="movie-card">
                <a href="/movie-details.html">
                   <figure class="card-banner">
                      <img src="/assets/images/movie-2.png" alt="Morbius movie poster">
                   </figure>
                </a>
                <div class="title-wrapper">
                   <a href="/movie-details.html">
                      <h3 class="card-title">Morbius</h3>
                   </a>
                   <time datetime="2022">2022</time>
                </div>
                <div class="card-meta">
                   <div class="badge badge-outline">HD</div>
                   <div class="duration">
                      <ion-icon name="time-outline"></ion-icon>
                      <time datetime="PT104M">104 min</time>
                   </div>
                   <div class="rating">
                      <ion-icon name="star"></ion-icon>
                      <data>5.9</data>
                   </div>
                </div>
             </div>
          </li>
          <li>
             <div class="movie-card">
                <a href="/movie-details.html">
                   <figure class="card-banner">
                      <img src="/assets/images/movie-3.png" alt="The Adam Project movie poster">
                   </figure>
                </a>
                <div class="title-wrapper">
                   <a href="/movie-details.html">
                      <h3 class="card-title">The Adam Project</h3>
                   </a>
                   <time datetime="2022">2022</time>
                </div>
                <div class="card-meta">
                   <div class="badge badge-outline">4K</div>
                   <div class="duration">
                      <ion-icon name="time-outline"></ion-icon>
                      <time datetime="PT106M">106 min</time>
                   </div>
                   <div class="rating">
                      <ion-icon name="star"></ion-icon>
                      <data>7.0</data>
                   </div>
                </div>
             </div>
          </li>
          <li>
             <div class="movie-card">
                <a href="/movie-details.html">
                   <figure class="card-banner">
                      <img src="/assets/images/movie-4.png" alt="Free Guy movie poster">
                   </figure>
                </a>
                <div class="title-wrapper">
                   <a href="/movie-details.html">
                      <h3 class="card-title">Free Guy</h3>
                   </a>
                   <time datetime="2021">2021</time>
                </div>
                <div class="card-meta">
                   <div class="badge badge-outline">4K</div>
                   <div class="duration">
                      <ion-icon name="time-outline"></ion-icon>
                      <time datetime="PT115M">115 min</time>
                   </div>
                   <div class="rating">
                      <ion-icon name="star"></ion-icon>
                      <data>7.7</data>
                   </div>
                </div>
             </div>
          </li>
       </ul> --}}

       <ul class=" nav nav-pills mb-3 filter-list" id="pills-tab" role="tablist">
         <li class="nav-item">
           <a class="nav-link active filter-btn" id="pills-home-tab" data-toggle="pill" href="#ngay" role="tab" aria-controls="pills-home" aria-selected="true">Ngày</a>
         </li>
         <li class="nav-item">
           <a class="nav-link filter-btn" id="pills-profile-tab" data-toggle="pill" href="#tuan" role="tab" aria-controls="pills-profile" aria-selected="false">Tuần</a>
         </li>
         <li class="nav-item">
           <a class="nav-link filter-btn" id="pills-contact-tab" data-toggle="pill" href="#thang" role="tab" aria-controls="pills-contact" aria-selected="false">Tháng</a>
         </li>
       </ul>
       <div class="tab-content" id="pills-tabContent">
         <div class="tab-pane fade show active" id="ngay" role="tabpanel" aria-labelledby="pills-home-tab">
            <ul class="movies-list">
               <li>
                  <div class="movie-card">
                     <a href="/movie-details.html">
                        <figure class="card-banner">
                           <img src="/assets/images/movie-1.png" alt="Sonic the Hedgehog 2 movie poster">
                        </figure>
                     </a>
                     <div class="title-wrapper">
                        <a href="/movie-details.html">
                           <h3 class="card-title">Sonic the Hedgehog 2</h3>
                        </a>
                        <time datetime="2022">2022</time>
                     </div>
                     <div class="card-meta">
                        <div class="badge badge-outline">2K</div>
                        <div class="duration">
                           <ion-icon name="time-outline"></ion-icon>
                           <time datetime="PT122M">122 min</time>
                        </div>
                        <div class="rating">
                           <ion-icon name="star"></ion-icon>
                           <data>7.8</data>
                        </div>
                     </div>
                  </div>
               </li>
               <li>
                  <div class="movie-card">
                     <a href="/movie-details.html">
                        <figure class="card-banner">
                           <img src="/assets/images/movie-2.png" alt="Morbius movie poster">
                        </figure>
                     </a>
                     <div class="title-wrapper">
                        <a href="/movie-details.html">
                           <h3 class="card-title">Morbius</h3>
                        </a>
                        <time datetime="2022">2022</time>
                     </div>
                     <div class="card-meta">
                        <div class="badge badge-outline">HD</div>
                        <div class="duration">
                           <ion-icon name="time-outline"></ion-icon>
                           <time datetime="PT104M">104 min</time>
                        </div>
                        <div class="rating">
                           <ion-icon name="star"></ion-icon>
                           <data>5.9</data>
                        </div>
                     </div>
                  </div>
               </li>
               <li>
                  <div class="movie-card">
                     <a href="/movie-details.html">
                        <figure class="card-banner">
                           <img src="/assets/images/movie-3.png" alt="The Adam Project movie poster">
                        </figure>
                     </a>
                     <div class="title-wrapper">
                        <a href="/movie-details.html">
                           <h3 class="card-title">The Adam Project</h3>
                        </a>
                        <time datetime="2022">2022</time>
                     </div>
                     <div class="card-meta">
                        <div class="badge badge-outline">4K</div>
                        <div class="duration">
                           <ion-icon name="time-outline"></ion-icon>
                           <time datetime="PT106M">106 min</time>
                        </div>
                        <div class="rating">
                           <ion-icon name="star"></ion-icon>
                           <data>7.0</data>
                        </div>
                     </div>
                  </div>
               </li>
               <li>
                  <div class="movie-card">
                     <a href="/movie-details.html">
                        <figure class="card-banner">
                           <img src="/assets/images/movie-4.png" alt="Free Guy movie poster">
                        </figure>
                     </a>
                     <div class="title-wrapper">
                        <a href="/movie-details.html">
                           <h3 class="card-title">Free Guy</h3>
                        </a>
                        <time datetime="2021">2021</time>
                     </div>
                     <div class="card-meta">
                        <div class="badge badge-outline">4K</div>
                        <div class="duration">
                           <ion-icon name="time-outline"></ion-icon>
                           <time datetime="PT115M">115 min</time>
                        </div>
                        <div class="rating">
                           <ion-icon name="star"></ion-icon>
                           <data>7.7</data>
                        </div>
                     </div>
                  </div>
               </li>
            </ul>
         </div>
         <div class="tab-pane fade" id="tuan" role="tabpanel" aria-labelledby="pills-profile-tab">
            <ul class="movies-list">
               <li>
                  <div class="movie-card">
                     <a href="/movie-details.html">
                        <figure class="card-banner">
                           <img src="/assets/images/movie-1.png" alt="Sonic the Hedgehog 2 movie poster">
                        </figure>
                     </a>
                     <div class="title-wrapper">
                        <a href="/movie-details.html">
                           <h3 class="card-title">Sonic the Hedgehog 2</h3>
                        </a>
                        <time datetime="2022">2022</time>
                     </div>
                     <div class="card-meta">
                        <div class="badge badge-outline">2K</div>
                        <div class="duration">
                           <ion-icon name="time-outline"></ion-icon>
                           <time datetime="PT122M">122 min</time>
                        </div>
                        <div class="rating">
                           <ion-icon name="star"></ion-icon>
                           <data>7.8</data>
                        </div>
                     </div>
                  </div>
               </li>
               <li>
                  <div class="movie-card">
                     <a href="/movie-details.html">
                        <figure class="card-banner">
                           <img src="/assets/images/movie-2.png" alt="Morbius movie poster">
                        </figure>
                     </a>
                     <div class="title-wrapper">
                        <a href="/movie-details.html">
                           <h3 class="card-title">Morbius</h3>
                        </a>
                        <time datetime="2022">2022</time>
                     </div>
                     <div class="card-meta">
                        <div class="badge badge-outline">HD</div>
                        <div class="duration">
                           <ion-icon name="time-outline"></ion-icon>
                           <time datetime="PT104M">104 min</time>
                        </div>
                        <div class="rating">
                           <ion-icon name="star"></ion-icon>
                           <data>5.9</data>
                        </div>
                     </div>
                  </div>
               </li>
               <li>
                  <div class="movie-card">
                     <a href="/movie-details.html">
                        <figure class="card-banner">
                           <img src="/assets/images/movie-3.png" alt="The Adam Project movie poster">
                        </figure>
                     </a>
                     <div class="title-wrapper">
                        <a href="/movie-details.html">
                           <h3 class="card-title">The Adam Project</h3>
                        </a>
                        <time datetime="2022">2022</time>
                     </div>
                     <div class="card-meta">
                        <div class="badge badge-outline">4K</div>
                        <div class="duration">
                           <ion-icon name="time-outline"></ion-icon>
                           <time datetime="PT106M">106 min</time>
                        </div>
                        <div class="rating">
                           <ion-icon name="star"></ion-icon>
                           <data>7.0</data>
                        </div>
                     </div>
                  </div>
               </li>
            </ul>
         </div>
         <div class="tab-pane fade" id="thang" role="tabpanel" aria-labelledby="pills-contact-tab">
            <ul class="movies-list">
               <li>
                  <div class="movie-card">
                     <a href="/movie-details.html">
                        <figure class="card-banner">
                           <img src="/assets/images/movie-1.png" alt="Sonic the Hedgehog 2 movie poster">
                        </figure>
                     </a>
                     <div class="title-wrapper">
                        <a href="/movie-details.html">
                           <h3 class="card-title">Sonic the Hedgehog 2</h3>
                        </a>
                        <time datetime="2022">2022</time>
                     </div>
                     <div class="card-meta">
                        <div class="badge badge-outline">2K</div>
                        <div class="duration">
                           <ion-icon name="time-outline"></ion-icon>
                           <time datetime="PT122M">122 min</time>
                        </div>
                        <div class="rating">
                           <ion-icon name="star"></ion-icon>
                           <data>7.8</data>
                        </div>
                     </div>
                  </div>
               </li>
               <li>
                  <div class="movie-card">
                     <a href="/movie-details.html">
                        <figure class="card-banner">
                           <img src="/assets/images/movie-2.png" alt="Morbius movie poster">
                        </figure>
                     </a>
                     <div class="title-wrapper">
                        <a href="/movie-details.html">
                           <h3 class="card-title">Morbius</h3>
                        </a>
                        <time datetime="2022">2022</time>
                     </div>
                     <div class="card-meta">
                        <div class="badge badge-outline">HD</div>
                        <div class="duration">
                           <ion-icon name="time-outline"></ion-icon>
                           <time datetime="PT104M">104 min</time>
                        </div>
                        <div class="rating">
                           <ion-icon name="star"></ion-icon>
                           <data>5.9</data>
                        </div>
                     </div>
                  </div>
               </li>
            </ul>
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