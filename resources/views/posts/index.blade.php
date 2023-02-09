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

<!-- Modal para crear nueva entrada-->
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
                <button type="button" class="btn btn-primary btn-sm addStudent">Crear</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function () {
        $(document).on('click', '.addStudent', function (e) {
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
                        console.log(response);
                    } else {
                        console.log(response);
                        $('#errores').html(response.mensaje);
                        
                        
                    }
                }
            });
        });
    });
</script>
@endpush