/**Editar categoria */

$('.btnEditarCategoria').click(function () {
    var idCategoria = $(this).attr('idCategoria');

    var datos = new FormData();
    datos.append('idCategoria', idCategoria);

    $.ajax({
        url: "ajax/categorias.ajax.php",
        method: "post",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            $('#editarCategoria').val(respuesta['categoria']);
            $('#idCategoria').val(respuesta['id']);
        },
        error: function (error) {
            console.log('error', error);
        },
    });
});

/**Eliminar categoria */

$('.btnEliminarCategoria').click(function () {
    var idCategoria = $(this).attr('idCategoria');


    Swal.fire({
        icon: "warning",
        title: "¿Está seguro de borrar la categoría?",
        text: "¡Si no lo está puede cancelar la opción",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, borrar categoría!",
    }).then((result) => {
        if (result.value) {
            window.location = "index.php?ruta=categorias&idCategoria=" + idCategoria;
        }
    });

});