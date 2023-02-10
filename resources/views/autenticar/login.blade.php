<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.108.0">
        <title>Iniciar sesión</title>

        {{-- Bootstrap 5 CSS --}}
        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">

        {{-- CSS Login --}}
        <link href="{{asset('assets/css/sign-in.css')}}" rel="stylesheet">
    </head>
    <body class="text-center">
        <main class="form-signin w-100 m-auto">
            <small id="mensaje"></small>
            <form id="formularioLogin">
                <h1>Larablog</h1>
                <div class="form-floating">
                    <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email" required>
                    <label for="floatingInput">Email</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
                    <label for="floatingPassword">Contraseña</label>
                </div>
                <button class="w-100 btn btn-lg btn-primary login" type="submit">Iniciar sesión</button>
            </form>
            <form id="formularioInicio" class="text-center" style="display: none;">
                <h1>Larablog</h1>
                <br>
                <a href="/" class="btn btn-sm btn-outline-secondary">Inicio</a>
            </form>
        </main>

    {{-- Bootstrap 5 JS --}}
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

    {{-- JQuery CDN --}}
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

    <script>
        $(document).ready(function () {

            // Evento para acceder al sistema
            $(document).on('click', '.login', function (e) {
                e.preventDefault();

                let datos = {
                    'email': $('#email').val(),
                    'password': $('#password').val(),
                }

                $.ajax({
                    type: "POST",
                    url: "/api/login",
                    data: datos,
                    dataType: "json",
                    success: function (response) {
                        switch (response.estado) {
                            case 200:
                                    localStorage.setItem("token", response.token);
                                    $('#formularioLogin').trigger("reset");
                                    $('#formularioLogin').css('display','none');
                                    $('#formularioInicio').css('display','block');
                                    $('#mensaje').html(response.mensaje);
                                    console.log(response);
                                break;
                            case 403:
                                $('#mensaje').html(response.mensaje);
                                break;
                            case 404:
                                $('#mensaje').html(response.mensaje);
                                break;
                            default:
                                alert('No se puede hacer esta acción.');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>