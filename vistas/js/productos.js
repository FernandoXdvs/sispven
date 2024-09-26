/**Cargar la tabla dinamica de productos */
$('.tablaProductos').DataTable({
    deferRender: true,
    retrieve: true,
    processing: true,
    paging: true,
    lengthChange: true,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: false,
    responsive: true,
    language: {
        sProcessing: "Procesando...",
        sLengthMenu: "Mostrar _MENU_ registros",
        sZeroRecords: "No se encontraron resultados",
        sEmptyTable: "Ningún dato disponible en esta tabla",
        sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
        sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
        sInfoPostFix: "",
        sSearch: "Buscar:",
        sUrl: "",
        sInfoThousands: ",",
        sLoadingRecords: "Cargando...",
        oPaginate: {
            sFirst: "Primero",
            sLast: "Último",
            sNext: "Siguiente",
            sPrevious: "Anterior"
        },
        oAria: {
            sSortAscending: ": Activar para ordenar la columna de manera ascendente",
            sSortDescending: ": Activar para ordenar la columna de manera descendente"
        },
    },
    ajax: "ajax/datatable-productos.ajax.php",
});

/**Capturando la categoria para asignar el codigo */

$("#nuevaCategoria").change(function () {

    var idCategoria = $(this).val();

    var datos = new FormData();
    datos.append("idCategoria", idCategoria);

    $.ajax({
        url: "ajax/productos.ajax.php",
        method: "post",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            var nuevoCodigo = null;
            if (!respuesta) {
                nuevoCodigo = idCategoria + "01";
            } else {
                nuevoCodigo = Number(respuesta["codigo"]) + 1;
            }

            $("#nuevoCodigo").val(nuevoCodigo);
        },
        error: function (error) {
            console.log("error", error);
        }
    });

});


/**Agregando precio de venta */

$("#nuevoPrecioCompra").change(function () {
    if ($(".porcentaje").prop("checked")) {
        var valorPorcentaje = $(".nuevoPorcentaje").val();

        var porcentaje = Number($("#nuevoPrecioCompra").val() * valorPorcentaje / 100) + Number($("#nuevoPrecioCompra").val());

        $("#nuevoPrecioVenta").val(porcentaje);

        $("#nuevoPrecioVenta").prop("readonly", true);
    } else {
        $("#nuevoPrecioVenta").prop("readonly", false);
    }

});

/**Cambio de porcentaje */

$(".nuevoPorcentaje").change(function () {
    if ($(".porcentaje").prop("checked")) {
        var valorPorcentaje = $(".nuevoPorcentaje").val();

        var porcentaje = Number($("#nuevoPrecioCompra").val() * valorPorcentaje / 100) + Number($("#nuevoPrecioCompra").val());

        $("#nuevoPrecioVenta").val(porcentaje);

        $("#nuevoPrecioVenta").prop("readonly", true);
    }
});

/**Si se desea aumentar un porcentaje al precio de venta o no */

$(".porcentaje").change(function () {
    if (!$(".porcentaje").prop("checked")) {
        $("#nuevoPrecioVenta").prop("readonly", false);
    } else {
        var valorPorcentaje = $(".nuevoPorcentaje").val();
        var porcentaje = Number($("#nuevoPrecioCompra").val() * valorPorcentaje / 100) + Number($("#nuevoPrecioCompra").val());

        $("#nuevoPrecioVenta").val(porcentaje);
        $("#nuevoPrecioVenta").prop("readonly", true);
    }

});

/**Agregando precio de venta editar*/

$("#editarPrecioCompra").change(function () {
    if ($(".checkPorcentaje").prop("checked")) {
        var valorPorcentaje = $(".editarPorcentaje").val();

        var porcentaje = Number($("#editarPrecioCompra").val() * valorPorcentaje / 100) + Number($("#editarPrecioCompra").val());

        $("#editarPrecioVenta").val(porcentaje);

        $("#editarPrecioVenta").prop("readonly", true);
    } else {
        $("#editarPrecioVenta").prop("readonly", false);
    }

});


/**Cambio de porcentaje editar*/

$(".editarPorcentaje").change(function () {
    if ($(".checkPorcentaje").prop("checked")) {
        var valorPorcentaje = $(".editarPorcentaje").val();

        var porcentaje = Number($("#editarPrecioCompra").val() * valorPorcentaje / 100) + Number($("#editarPrecioCompra").val());

        $("#editarPrecioVenta").val(porcentaje);

        $("#editarPrecioVenta").prop("readonly", true);
    }
});

/**Si se desea aumentar un porcentaje al precio de venta o no en editar */


$(".checkPorcentaje").change(function(){
    if (!$(".checkPorcentaje").prop("checked")) {
        $("#editarPrecioVenta").prop("readonly", false);
    } else {
        var valorPorcentaje = $(".editarPorcentaje").val();
        var porcentaje = Number($("#editarPrecioCompra").val() * valorPorcentaje / 100) + Number($("#editarPrecioCompra").val());

        $("#editarPrecioVenta").val(porcentaje);
        $("#editarPrecioVenta").prop("readonly", true);
    }
});



/**Subir imagen */

$('.nuevaImagen').change((e) => {
    var imagen = e.target.files[0];

    /**Validar formato de imagen */
    if (imagen['type'] != "image/jpeg" && imagen['type'] != "image/png") {
        $('.nuevaFoto').val("");
        Swal.fire({
            icon: "error",
            title: "Error al subir la imagen",
            text: "¡La imagen debe estar en formato JPG o PNG!",
            confirmButtonText: "Cerrar",
        });
    } else if (imagen['size'] > 5000000) {
        $('.nuevaFoto').val("");
        Swal.fire({
            icon: "error",
            title: "Error al subir la imagen",
            text: "¡La imagen no debe pesar mas de 5 MB!",
            confirmButtonText: "Cerrar",
        });
    } else {
        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);

        $(datosImagen).on("load", (e) => {
            var rutaImagen = e.target.result;

            $('.previsualizar').attr("src", rutaImagen);

        });
    }
});


/**Editar producto */

$(".tablaProductos tbody").on("click", "button.btnEditarProducto", function () {
    var idProducto = $(this).attr("idProducto");

    var datos = new FormData();
    datos.append("idProducto", idProducto);

    $.ajax({
        url: "ajax/productos.ajax.php",
        method: "post",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            var datosCategoria = new FormData();
            datosCategoria.append("idCategoria", respuesta["id_categoria"]);

            $.ajax({
                url: "ajax/categorias.ajax.php",
                method: "post",
                data: datosCategoria,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (respuesta) {
                    $("#editarCategoria").val(respuesta["id"]);
                    $("#editarCategoria").html(respuesta["categoria"]);
                },
                error: function (error) {
                    console.log("error", error);
                }
            });

            $("#editarCodigo").val(respuesta["codigo"]);
            $("#editarDescripcion").val(respuesta["descripcion"]);
            $("#editarStock").val(respuesta["stock"]);
            $("#editarPrecioCompra").val(respuesta["precio_compra"]);
            $("#editarPrecioVenta").val(respuesta["precio_venta"]);

            if(respuesta["imagen"]!=""){
                $("#imagenActual").val(respuesta["imagen"]);
                $(".previsualizar").attr("src",respuesta["imagen"]);
            }
        },
        error: function (error) {
            console.log("error", error);
        }
    });

});




