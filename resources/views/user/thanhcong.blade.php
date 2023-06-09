<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Gói</title>


    <!--
    - favicon
  -->
    <link rel="shortcut icon" href="/favicon.svg" type="image/svg+xml">

    <!--
    - custom css link
  -->
    <link rel="stylesheet" href="/assets/css/style.css">

    <!--
    - google font link
  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />
</head>

<body id="#top">
    @if (Session::has('error'))
        <script>
            document.addEventListener("DOMContentLoaded", function(event) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: '{{ Session::get('error') }}',
                    showConfirmButton: false,
                    timer: 1500
                })
            })
        </script>
    @endif
    @if (Session::has('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function(event) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '{{ Session::get('success') }}',
                    showConfirmButton: false,
                    timer: 1500
                })
            })
        </script>
    @endif

    <!--
    - #HEADER
  -->

    <header class="header" data-header>
        <div class="container">

            <div class="overlay" data-overlay></div>

            <a href="/index.html" class="logo">
                <img style="width: 75px; height:75px" src="/assets/images/logotrung.png" alt="Filmlane logo">
            </a>

            <div class="header-actions">

                <button class="search-btn">
                    <ion-icon name="search-outline"></ion-icon>
                </button>

                <div class="lang-wrapper">
                    <label for="language">
                        <ion-icon name="globe-outline"></ion-icon>
                    </label>

                    <select name="language" id="language">
                        <option value="en">EN</option>
                        <option value="au">AU</option>
                        <option value="ar">AR</option>
                        <option value="tu">TU</option>
                    </select>
                </div>

                <!-- <button class="btn btn-primary">Sign in</button> -->

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

                <!-- <ul class="navbar-list">

          <li>
            <a href="/index.html" class="navbar-link">Home</a>
          </li>

          <li>
            <a href="#" class="navbar-link">Movie</a>
          </li>

          <li>
            <a href="#" class="navbar-link">Tv Show</a>
          </li>

          <li>
            <a href="#" class="navbar-link">Web Series</a>
          </li>

          <li>
            <a href="#" class="navbar-link">Pricing</a>
          </li>

        </ul> -->

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





    <main>
        <article>


            <!--
        - #TV SERIES
      -->
        <style>
            .form-check-inline {
                display: inline-block;
                width: 22%; /* chia đều cho 4 cột */
                box-sizing: border-box; /* giữa các padding, border không ảnh hưởng đến chiều rộng của ô */
                padding-right: 10px; /* tạo khoảng cách giữa các ô */
                padding-left: 12%;
                color: white;
            }
            .checkbox-container {
            display: flex; /* đảm bảo các ô được sắp xếp trên cùng một dòng */
            flex-wrap: wrap; /* nếu không đủ chỗ thì dòng mới bắt đầu */
            margin: -10px 0; /* xóa khoảng cách giữa các dòng */
            }
        </style>
            <section class="tv-series">
                <div class="container">
                    <div style="margin: 80px 0 50px 0">
                        <h1 style="color: yellow; text-align:center">CHÚC MỪNG BẠN ĐÃ ĐĂNG KÝ GÓI THÀNH CÔNG !</h1>
                        <h4 style="color: yellow; text-align:center">VUI LÒNG CHỌN CÁC THỂ LOẠI PHIM YÊU THÍCH</h4>

                    </div>
                    <div>
                        <form action="{{route('dktheloai')}}" method="post">
                        @csrf
                        <div style="margin-bottom: 80px">
                
                          @foreach ($listtheloai as $key => $item)
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="theloai[]" id="{{$item->id}}" value="{{$item->id}}" />
                            <label class="form-check-label" for="{{$item->id}}">{{$item->tieude}}</label>
                          </div>
                          @endforeach
                        </div>
                        <button style="background: yellow; color:black" type="submit" class="btn btn-primary btn-block mb-3">BẮT ĐẦU XEM PHIM</button>
                        </form>
                    </div>


                </div>
            </section>

        </article>
    </main>





    <!--
    - #FOOTER
  -->

    <footer class="footer">

        <div class="footer-top">
            <div class="container">

                <div class="footer-brand-wrapper">

                    <a href="/index.html" class="logo">
                        <img style="width: 75px; height:75px" src="/assets/images/logotrung.png" alt="Filmlane logo">
                    </a>

                    <ul class="footer-list">

                        <li>
                            <a href="/index.html" class="footer-link">Home</a>
                        </li>

                        <li>
                            <a href="#" class="footer-link">Movie</a>
                        </li>

                        <li>
                            <a href="#" class="footer-link">TV Show</a>
                        </li>

                        <li>
                            <a href="#" class="footer-link">Web Series</a>
                        </li>

                        <li>
                            <a href="#" class="footer-link">Pricing</a>
                        </li>

                    </ul>

                </div>

                <div class="divider"></div>

                <div class="quicklink-wrapper">

                    <ul class="quicklink-list">

                        <li>
                            <a href="#" class="quicklink-link">Faq</a>
                        </li>

                        <li>
                            <a href="#" class="quicklink-link">Help center</a>
                        </li>

                        <li>
                            <a href="#" class="quicklink-link">Terms of use</a>
                        </li>

                        <li>
                            <a href="#" class="quicklink-link">Privacy</a>
                        </li>

                    </ul>

                    <ul class="social-list">

                        <li>
                            <a href="#" class="social-link">
                                <ion-icon name="logo-facebook"></ion-icon>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="social-link">
                                <ion-icon name="logo-twitter"></ion-icon>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="social-link">
                                <ion-icon name="logo-pinterest"></ion-icon>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="social-link">
                                <ion-icon name="logo-linkedin"></ion-icon>
                            </a>
                        </li>

                    </ul>

                </div>

            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">

                <p class="copyright">
                    &copy; 2022 <a href="#">codewithsadee</a>. All Rights Reserved
                </p>

                <img src="/assets/images/footer-bottom-img.png" alt="Online banking companies logo"
                    class="footer-bottom-img">

            </div>
        </div>

    </footer>





    <!--
    - #GO TO TOP
  -->

    <a href="#top" class="go-top" data-go-top>
        <ion-icon name="chevron-up"></ion-icon>
    </a>





    <!--
    - custom js link
  -->
    <script src="/assets/js/script.js"></script>

    <!--
    - ionicon link
  -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>


</html>
