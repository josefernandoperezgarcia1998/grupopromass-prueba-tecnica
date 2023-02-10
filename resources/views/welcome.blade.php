@extends('layouts.general')

@section('titulo', 'Larablog')

@section('contenido')
<div class="p-4 p-md-5 mb-4 rounded text-bg-dark">
    <div class="col-md-6 px-0">
        <p class="lead mb-0">¿No encuentras el post? ¡Búscalo!</p>
    </div>
    <input type="text" id="buscador" class="form-control inputBuscador" placeholder="Buscador...">
</div>

<div class="row g-5">
    
    <div class="col-md-8">
        <article id="listadoPosts" class="blog-post">
        </article>
        <p id="mensaje"></p>
        <article id="buscadorPosts">
            <br>
            <div id="resultado"></div>
        </article>
    </div>

    <div class="col-md-4">
        <div class="position-sticky" style="top: 2rem;">
            <div class="p-4 mb-3 bg-light rounded">
                <h4 class="fst-italic">Realizado por</h4>
                <p class="mb-0">José Fernando Pérez García.</p>
                <p class="mb-0">Web Developer.</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>

    let buscador = $('#buscador');

    $(document).ready(function () {

        listadoPosts()

        // Función para listar todos los posts
        function listadoPosts()
        {
            $.ajax({
                type: "GET",
                url: "/api/listado-posts-general",
                dataType: "json",
                success: function (response) {
                    // $('#listadoPosts').html('');
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

        $(buscador).click(function() {
            $(buscador).keyup(function(){
                if($(this).val().length == 0){
                    
                    $('#listadoPosts').css('display', 'block');
                    $('#buscadorPosts').css('display','none');
                }
                else if($(this).val().length >= 0) {
                    
                    let post = $('#buscador').val();
                    $('#listadoPosts').css('display', 'none');
                    $('#buscadorPosts').css('display', 'block');
                    
                    $.ajax({
                        url: "/api/buscador-post",
                        type: 'GET',
                        data: {
                            post: post,
                        },
                        success: function(response){
                            console.log(response);
                            if (response.contador > 0) {
                                $.each(response.posts, function (key, post) { 
                                    $('#buscadorPosts').append(
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
                            } else {
                                
                                $('#listadoPosts').css('display', 'none');
                                $('#buscadorPosts').css('display','none');
                            }
                            $('#mensaje').html(response.mensaje +' '+response.contador );
                        }
                    })
                }
            });
        });

    });
</script>
@endpush