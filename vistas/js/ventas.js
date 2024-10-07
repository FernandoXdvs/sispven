/**Reseteamos el localStorage */

window.onload = function () {
    localStorage.removeItem("quitarProducto");
};

/**Cargar la tabla dinamica de productos */
$('.tablaCrearVenta').DataTable({
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
    ajax: "ajax/datatable-ventas.ajax.php",
});


/**Agregar productos de una tabla a la otra */

var idPonerProducto = [];

$(".tablaCrearVenta tbody").on("click", "button.agregarProducto", function () {

    var idProducto = $(this).attr("idProducto");
    var codigo = $(this).attr("id");

    /**Almacenar en el local storage el codigo de producto puesto */

    if (localStorage.getItem("ponerProducto") == null) {
        idPonerProducto = [];
    } else {
        idPonerProducto.concat(localStorage.getItem("ponerProducto"));
    }

    idPonerProducto.push({
        "codigoProducto": codigo
    });

    localStorage.setItem("ponerProducto", JSON.stringify(idPonerProducto));


    $(this).removeClass("btn-primary agregarProducto");
    $(this).addClass("btn-default");

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

            var idProducto = respuesta["id"];
            var codigoProducto = respuesta["codigo"];
            var descripcion = respuesta["descripcion"];
            var stock = respuesta["stock"];
            var precio = respuesta["precio_venta"];

            /**Evitar agregar productos con el stock en cero */

            if (stock == 0) {
                Swal.fire({
                    icon: "error",
                    title: "No hay stock disponible",
                    confirmButtonText: "¡Cerrar!",
                });

                $("#"+codigo).addClass("btn-primary agregarProducto");
                $("#"+codigo).removeClass("btn-default");

            } else {


                $(".nuevoProducto").append(
                    '<div style="display:flex;">' +
                    '<div class="col-md-6" style="padding-right:0px; margin-top:5px;">' +
                    '<div class="input-group">' +
                    '<div class="input-group-prepend">' +
                    '<span class="input-group-text">' +
                    '<button type="button" class="btn btn btn-danger btn-xs quitarProducto"  idCodigo="' + codigoProducto + '"  idProducto="' + idProducto + '">' +
                    '<i class="fa fa-times"></i>' +
                    '</button>' +
                    '</span>' +
                    '</div>' +
                    '<input type="text" class="form-control" id="agregarProducto" name="agregarProducto" value="' + descripcion + '" readonly>' +
                    '</div>' +
                    '</div >' +
                    '<div class="col-md-3" style="padding-right:0px; margin-top:5px;">' +
                    '<input type="number" class="form-control" id="nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="' + stock + '" required >' +
                    '</div>' +
                    '<div class="col-md-3" style="padding-left: 0px; margin-top:5px;">' +
                    '<div class="input-group" style="margin-left:3px;">' +
                    '<div class="input-group-prepend">' +
                    '<span class="input-group-text">' +
                    '<i class="fa fa-dollar-sign"></i>' +
                    '</span>' +
                    '</div>' +
                    '<input type="number" class="form-control" min="1" id="nuevoPrecioProducto" name="nuevoPrecioProducto" value="' + precio + '" readonly required>' +
                    '</div>' +
                    '</div>' +
                    '</div>');
            }
        }

    });


});

/**Cuando cargue la tabla cuando se navegue el ella */
$(".tablaCrearVenta").on("draw.dt", function () {


    var quitados;
    if (localStorage.getItem("quitarProducto") != null) {
        var listaProductos = JSON.parse(localStorage.getItem("quitarProducto"));

        quitados = listaProductos;
        for (let i = 0; i < listaProductos.length; i++) {

            $("#" + listaProductos[i]["idProducto"] + "").removeClass("btn-default");
            $("#" + listaProductos[i]["idProducto"] + "").addClass("btn-primary agregarProducto");

        }
    }
    localStorage.removeItem("quitarProducto");

});

/**Quitar productos de la venta */

var idQuitarProducto = [];

$(".formularioVenta").on("click", "button.quitarProducto", function () {

    $(this).parent().parent().parent().parent().parent().remove();

    var codigo = $(this).attr("idCodigo");

    $("#" + codigo + "").removeClass("btn-default");
    $("#" + codigo + "").addClass("btn-primary agregarProducto");

    /**Almacenar en el local storage el id de producto a quitar */

    if (localStorage.getItem("quitarProducto") == null) {
        idQuitarProducto = [];
    } else {
        idQuitarProducto.concat(localStorage.getItem("quitarProducto"));
    }

    idQuitarProducto.push({
        "idProducto": codigo
    });

    localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

});
