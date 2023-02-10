@extends('layouts.general')

@section('contenido')
<div class="d-flex justify-content-between">
    <div>
        <h1 class="display-6">Listado de entradas</h1>
    </div>
    <div>
        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCrearEntrada">
            Nueva entrada
        </button>
    </div>
</div>
<div class="row">
    <small id="mensaje"></small>
    <div class="col">
        <article id="listadoPosts" class="blog-post">
        </article>
    </div>
</div>

{{-- Modal para crear nueva entrada --}}
<div class="modal fade" id="modalCrearEntrada" tabindex="-1" aria-labelledby="modalCrearEntradaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalCrearEntradaLabel">Crear nuevo post</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <small id="errores" class="text-danger"></small>
                <div class="mb-3">
                    <label for="titulo" class="form-label">Titulo</label>
                    <input type="text" class="form-control" id="titulo" aria-describedby="tituloHelp">
                </div>
                <div class="mb-3">
                    <label for="contenido" class="form-label">Contenido</label>
                    <textarea type="text" class="form-control" id="contenido" aria-describedby="contenidoHelp"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-sm crearEntrada">Crear</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal para ver una entrada --}}
<div class="modal fade" id="modalVerEntrada" tabindex="-1" aria-labelledby="modalVerEntradaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalVerEntradaLabel">Acerca del post</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <h6 class="text-muted"><strong>Título</strong></h6>
                    <p id="verTituloPost" class="text-secondary"></p>
                </div>
                <div class="mb-3">
                    <h6 class="text-muted"><strong>Contenido</strong></h6>
                    <p id="verContenidoPost" class="text-secondary"></p>
                </div>
                <div class="mb-3">
                    <h6 class="text-muted"><strong>Autor</strong></h6>
                    <p id="verAutorPost" class="text-secondary"></p>
                </div>
                <div class="mb-3">
                    <h6 class="text-muted"><strong>Fecha de publicación</strong></h6>
                    <p id="verFechaPost" class="text-secondary"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function () {

        listadoPosts()

        // Función para listar todos los posts
        function listadoPosts()
        {
            $.ajax({
                type: "GET",
                url: "/api/listado-posts",
                dataType: "json",
                success: function (response) {
                    $('#listadoPosts').html('');
                    $.each(response.posts, function (key, post) { 
                        $('#listadoPosts').append(
                            '<div class="d-flex justify-content-between">\
                                <div>\
                                    <h4>'+post.titulo+'</h4>\
                                </div>\
                                <div>\
                                    <button class="btn btn-sm btn-light verPost" value="'+post.id+'">Leer<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16"><path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/></svg></button>\
                                </div>\
                            </div>\
                            <p class="blog-post-meta">'+new Date(post.created_at)+' by <a href="#">'+post.user.name+'</a></p>\
                            <span maxlength="20">'+post.contenido.slice(0,70)+'...</span>\
                            <hr>'
                        );
                    });
                }
            });
        }

        // Evento para crear una entrada de post
        $(document).on('click', '.crearEntrada', function (e) {
            e.preventDefault();

            let datos = {
                'titulo': $('#titulo').val(),
                'contenido': $('#contenido').val(),
            }

            $.ajax({
                type: "POST",
                url: "/api/posts",
                data: datos,
                dataType: "json",
                success: function (response) {
                    if(response.estado == 200){
                        $('#mensaje').html(response.mensaje);
                        $('#mensaje').addClass('alert alert-primary');
                        $('#modalCrearEntrada').modal('hide');
                        $('#modalCrearEntrada').find('input').val('');
                        listadoPosts()
                    } else {
                        console.log(response);
                        $('#errores').html(response.mensaje);
                    }
                }
            });
        });

        // Evento para mostrar una entrada
        $(document).on('click', '.verPost', function (e) {
            e.preventDefault();

            // Obteniendo id del post
            let postId = $(this).val();

            $('#modalVerEntrada').modal('show');

            $.ajax({
                type: "GET",
                url: "/api/posts/"+postId,
                success: function (response) {
                    $('#verTituloPost').html(response.post.titulo);
                    $('#verContenidoPost').html(response.post.contenido);
                    $('#verAutorPost').html(response.post.user.name);
                    $('#verFechaPost').html(new Date(response.post.created_at));
                }
            });
        });
    });
</script>
@endpush