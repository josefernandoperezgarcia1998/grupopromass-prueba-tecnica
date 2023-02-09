$(document).ready(function() {
    listarEntradas()
});

// Listado de las entradas
function listarEntradas()
{
    $.get('listado-posts', {}, function(data, status) {
        $('#listadoPosts').html(data);
    });
}

// Crear una nueva entrada
function crearNuevaEntrada()
{
    $.get('vista-crear-post', {}, function(data, status) {
        $('#modalNuevaEntradaEtiqueta').html('Crear entrada');
        $("#contenido-modal").html(data);
        $('#modalNuevaEntrada').modal('show');
    });
}

// Guardar una nueva entrada
function guardarEntrada()
{
    let titulo = $('#titulo').val(), 
        contenido = $('#contenido').val(),
        _token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: "POST",
        url: 'guardar-post',
        // data: "titulo"+titulo,
        data: {
            titulo: titulo,
            contenido: contenido,
            _token: _token,
        },
        success: function(data)
        {
            if(data.estado == 200){
                $('.btn-close').click();
                listarEntradas()
            }
            
            if(data.estado == 422){
                $("#errores").html(data.mensaje);
            }
            
        },
        error: function(error)
        {
            console.log(error);
        }
    });
}

// Mostrar entrada
function mostrarEntrada(id)
{
    $.get('mostrar-post/'+id, {}, function(data, status) {
        $('#modalMostrarEntradaEtiqueta').html('Mostrar entrada');
        $("#contenido-modal-mostrar").html(data);
        $('#modalMostrarEntrada').modal('show');
    });
}