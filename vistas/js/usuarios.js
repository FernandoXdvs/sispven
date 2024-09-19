/*Subiendo foto del usuario */

$('.nuevaFoto').change((e) => {
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


/*Editar usuario */

$('.btnEditarUsuario').click(function () {

    var idUsuario = $(this).attr("idUsuario");

    var datos = new FormData();
    datos.append("idUsuario", idUsuario);

    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: 'post',
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (respuesta) {
            $('#editarNombre').val(respuesta['nombre']);
            $('#editarUsuario').val(respuesta['usuario']);
            $('#editarPerfil').html(respuesta['perfil']);

            $('#editarPerfil').val(respuesta['perfil']);

            $('#fotoActual').val(respuesta['foto']);

            $('#passwordActual').val(respuesta['password']);

            if (respuesta['foto'] != "") {
                $('.previsualizar').attr('src', respuesta['foto']);
            }
        },
        error: function (xhr) {
            console.log("error", JSON.stringify(xhr));
        }
    });
});

/**Activar usuario */

$('.btnActivar').click(function () {
    var idUsuario = $(this).attr("idUsuario");
    var estadoUsuario = $(this).attr("estadoUsuario");

    var datos = new FormData();
    datos.append("activarId", idUsuario);
    datos.append("activarUsuario", estadoUsuario);

    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: 'post',
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            realizado = true;
        },
        error: function (error) {
            console.log("error", error);
        }
    });


    if (estadoUsuario == 0) {
        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('Desactivado');
        $(this).attr('estadoUsuario', 1);
    } else {
        $(this).removeClass('btn-danger');
        $(this).addClass('btn-success');
        $(this).html('Activado');
        $(this).attr('estadoUsuario', 0);
    }

});