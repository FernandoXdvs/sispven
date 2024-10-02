/*Datatable */

$(function () {
    $(".tablaClientes").DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
});


/**Editar cliente */

$(".tablaClientes tbody").on("click", "button.btnEditarCliente", function () {
    var idCliente = $(this).attr("idCliente");

    var datos = new FormData();
    datos.append("idCliente", idCliente);

    $.ajax({
        url: "ajax/clientes.ajax.php",
        method: "post",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            $("#idCliente").val(respuesta['id']);
            $("#editarCliente").val(respuesta['nombre']);
            $("#editarDocumentoId").val(respuesta['documento']);
            $("#editarEmail").val(respuesta['email']);
            $("#editarTelefono").val(respuesta['telefono']);
            $("#editarDireccion").val(respuesta['direccion']);
            $("#editarFechaNacimiento").val(respuesta['fecha_nacimiento']);



        },
        error: function (error) {
            console.log("error", error);
        }
    });

});

/**Eliminar cliente */
$(".tablaClientes tbody").on("click", "button.btnEliminarCliente", function () {

    var idCliente = $(this).attr("idCliente");

    Swal.fire({
        icon: "warning",
        title: "¿Está seguro de eliminar este cliente?",
        text: "¡Si no lo está puede cancelar la opción",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, borrar cliente!",
    }).then((result) => {
        if (result.value) {
            window.location = "index.php?ruta=clientes&idCliente=" + idCliente;
        }
    });

});