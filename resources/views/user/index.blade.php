<!DOCTYPE html>
<html lang="en">
   <head>
      @include('user.layout_user.head')
   </head>
   <body id="top">
      @if(Session::has('error'))
        <script>
            document.addEventListener("DOMContentLoaded", function (event) {
                Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: '{{Session::get('error')}}',
                showConfirmButton: false,
                timer: 1500
                })
            })
        </script>
        @endif
        @if(Session::has('success'))
            <script>
                document.addEventListener("DOMContentLoaded", function (event) {
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '{{Session::get('success')}}',
                    showConfirmButton: false,
                    timer: 1500
                    })
                })
            </script>
        @endif
      <!-- 
         - #HEADER
         -->
      @include('user.layout_user.header')
      <main>
         <article>
          @yield('content')
         </article>
      </main>
      <!-- 
         - #FOOTER
         -->
      @include('user.layout_user.footer')
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
</html>