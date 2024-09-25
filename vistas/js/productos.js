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





