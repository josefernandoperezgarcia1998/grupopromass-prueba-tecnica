<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.108.0">
        <title>Registrar</title>

        {{-- Bootstrap 5 CSS --}}
        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">

        {{-- CSS Login --}}
        <link href="{{asset('assets/css/sign-in.css')}}" rel="stylesheet">
    </head>
    <body class="text-center">
        <main class="form-signin w-100 m-auto">
            <form id="formularioRegistrar">
                <h1>Larablog</h1>
                <p>Completa los siguientes campos</p>
                <div class="form-floating">
                    <input type="text" class="form-control" id="name" placeholder="Andrés Manuel López Obrador" name="name" required>
                    <label for="floatingInput">Nombre</label>
                </div>
                <div class="form-floating">
                    <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email" required>
                    <label for="floatingInput">Email</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
                    <label for="floatingPassword">Contraseña</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="confirmPassword" placeholder="Password" name="password_confirmation" required>
                    <label for="floatingPassword">Confirmar contraseña</label>
                </div>
                <button class="w-100 btn btn-lg btn-primary registrar" type="submit">Registrar</button>
            </form>
            <form id="redirecLogin" class="text-center" style="display: none;">
                <h1>Larablog</h1>
                <small id="mensaje" class="text-green"></small>
                <br>
                <a href="/vista-login" class="btn btn-sm btn-outline-secondary">Iniciar sesión</a>
            </form>
        </main>

        {{-- JQuery CDN --}}
        <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
        
        <script>
            $(document).ready(function () {

                // Evento para registrar un usuario
                $(document).on('click', '.registrar', function (e) {
                    e.preventDefault();

                    let datos = {
                        'name': $('#name').val(),
                        'email': $('#email').val(),
                        'password': $('#password').val(),
                        'password_confirmation': $('#confirmPassword').val(),
                    }

                    $.ajax({
                        type: "POST",
                        url: "/api/registrar",
                        data: datos,
                        dataType: "json",
                        success: function (response) {
                            if(response.estado == 200){
                                $('#formularioRegistrar').trigger("reset");
                                $('#formularioRegistrar').css('display','none');
                                $('#redirecLogin').css('display','block');
                                $('#mensaje').html(response.mensaje);
                            } else {
                                console.log(response);
                            }
                        }
                    });
                });
            });
        </script>
    </body>
</html>