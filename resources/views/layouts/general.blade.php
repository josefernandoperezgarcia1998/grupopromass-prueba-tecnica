<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('titulo')</title>

        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Bootstrap 5 CSS --}}
        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">

        {{-- Blog Bootstrap CSS --}}
        <link href="{{asset('assets/css/blog.css')}}" rel="stylesheet">

    </head>
    <body>  
        
        <div class="container">
            <header class="blog-header lh-1 py-3">
                <div class="row flex-nowrap justify-content-between align-items-center">

                    <div class="col-4 text-center">
                        <a class="blog-header-logo text-dark" href="#">Larablog</a>
                    </div>
                    <div class="col-4 d-flex justify-content-end align-items-center">
                        <a class="btn btn-sm btn-outline-secondary verPosts" href="/api/posts">Posts</a>
                        &nbsp;
                        <a class="btn btn-sm btn-outline-danger logout cerrarSesion" href="/api/logout">Logout</a>
                        <a class="btn btn-sm btn-outline-secondary login" href="{{route('login')}}">Login</a>
                        &nbsp;
                        <a class="btn btn-sm btn-outline-link registrar" href="{{route('registrar')}}">Registrar</a>
                    </div>
                </div>
            </header>
        </div>
        
        <br><br>
        
        <main class="container">
            @yield('contenido')
        </main>
        
        <footer class="blog-footer">
            <p>Made with by JFPG ❤</p>
            <p>
                <a href="#">Volver arriba</a>
            </p>
        </footer>

        {{-- Bootstrap 5 JS --}}
        <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

        {{-- JQuery CDN --}}
        <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
        
        <script>
            $(document).ready(function () {
                if(localStorage.getItem("token")){
                    $('.verPosts').css('display','block');
                    $('.logout').css('display','block');
                    $('.login').css('display','none');
                    $('.registrar').css('display','none');
                } else {
                    $('.verPosts').css('display','none');
                    $('.logout').css('display','none');
                    $('.login').css('display','block');
                    $('.registrar').css('display','block');
                }

                // Evento para cerrar sesión
                $(document).on('click', '.cerrarSesion', function () {

                    $.ajax({
                        type: "GET",
                        url: "/api/logout",
                        success: function (response) {
                            localStorage.removeItem("token");
                            if(response.estado == 200){
                                if(!alert('Sesión cerrada!')){window.location.reload();}
                            } else {
                                alert('Error al cerrar sesión, intente después');
                            }
                        }
                    });
                });
            });

        </script>

        {{-- JS --}}
        @stack('js')
    </body>
</html>
