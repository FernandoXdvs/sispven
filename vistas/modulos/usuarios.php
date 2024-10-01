<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Administrar Usuarios</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="inicio">
                                Inicio
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Administrar Usuarios</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">

                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
                    Agregar usuario
                </button>

            </div>

            <div class="card-body">

                <table class="table table-bordered table-striped  tablas">
                    <thead>
                        <tr>
                            <th style="width: 10px;">#</th>
                            <th>Nombre</th>
                            <th>Usuario</th>
                            <th>Foto</th>
                            <th>Perfil</th>
                            <th>Estado</th>
                            <th>Último login</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        $item = null;
                        $valor = null;
                        $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

                        foreach ($usuarios as $key => $usuario) {
                            echo '
                            <tr>
                            <td>' . ($key+1) . '</td>
                            <td>' . $usuario['nombre'] . '</td>
                            <td>' . $usuario['usuario'] . '</td>';
                            if ($usuario['foto']) {
                                echo '<td><img src="' . $usuario['foto'] . '" class="img-thumbnail" width="40px">
                                </td>';
                            } else {
                                echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px">
                                </td>';
                            }
                            echo '<td>' . $usuario['perfil'] . '</td>';

                            if ($usuario['estado'] != 0) {
                                echo '<td><button class="btn btn-success btn-xs btnActivar" 
                                idUsuario=' . $usuario['id'] . ' estadoUsuario="0">
                                Activado
                                </button></td>';
                            } else {
                                echo '<td><button class="btn btn-danger btn-xs btnActivar" 
                                idUsuario=' . $usuario['id'] . ' estadoUsuario="1">
                                Desactivado
                                </button></td>';

                            }
                            if (isset($usuario['ultimo_login'])) {
                                echo '<td>' . $usuario['ultimo_login'] . '</td>';
                            } else {
                                echo '<td>0000-00-00 00:00:00</td>';
                            }
                            echo '<td>
                                <div class="btn-group">
                                    <button class="btn btn-warning btnEditarUsuario" idUsuario="' . $usuario['id'] . '" data-toggle="modal" data-target="#modalEditarUsuario">
                                        <i class="fa fa-pen"></i>
                                    </button>
                                    <button class="btn btn-danger btnEliminarUsuario" idUsuario="' . $usuario['id'] . '" 
                                    fotoUsuario="'.$usuario['foto'].'" usuario="'.$usuario['usuario'].'"
                                    ><i class="fa fa-times"></i></button>
                                </div>
                            </td>
                        </tr>
                            ';
                        }


                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<!--==========================================
===========MODAL AGREGAR USUARIO============== 
===========================================-->
<div id="modalAgregarUsuario" class="modal fade" role="dialog">

    <!--Modal--->
    <div class="modal-dialog">

        <div class="modal-content">

            <!--Formulario-->
            <form role="form" method="post" enctype="multipart/form-data" action="">

                <div class="modal-header" style="background: #3c8dbc; color: white;">
                    <h5 class="modal-title">Agregar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style="color:white;" aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="box-body">

                        <!--Entrada nombre-->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control input-lg" name="nuevoNombre"
                                    placeholder="Ingresar nombre" required>
                            </div>
                        </div>

                        <!--Entrada usuario-->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-key"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control input-lg" name="nuevoUsuario" id="nuevoUsuario"
                                    placeholder="Ingresar usuario" required>
                            </div>
                        </div>

                        <!--Entrada contraseña-->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                </div>
                                <input type="password" class="form-control input-lg" name="nuevoPassword"
                                    placeholder="Ingresar contraseña" required>
                            </div>
                        </div>

                        <!--Entrada seleccionar perfil-->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-users"></i>
                                    </span>
                                </div>
                                <select class="form-control input-lg" name="nuevoPerfil">
                                    <option value="">Selecciona perfil</option>
                                    <option value="Administrador">Administrador</option>
                                    <option value="Especial">Especial</option>
                                    <option value="Vendedor">Vendedor</option>
                                </select>
                            </div>
                        </div>

                        <!--Entrada subir foto-->
                        <div class="form-group">
                            <div class="panel">SUBIR FOTO</div>
                            <input type="file" class="nuevaFoto" name="nuevaFoto">
                            <p class="help-block">Peso máximo de la foto 5 mb</p>
                            <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar"
                                width="100px">
                        </div>

                    </div>
                </div>

                <!-- Pie modal -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar usuario</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                </div>

                <?php

                $crearUsuario = new ControladorUsuarios();
                $crearUsuario->ctrCrearUsuario();

                ?>
            </form>
        </div>

    </div>

</div>

<!--==========================================
===========MODAL EDITAR USUARIO============== 
===========================================-->
<div id="modalEditarUsuario" class="modal fade" role="dialog">

    <!--Modal--->
    <div class="modal-dialog">

        <div class="modal-content">

            <!--Formulario-->
            <form role="form" method="post" enctype="multipart/form-data" action="">

                <div class="modal-header" style="background: #3c8dbc; color: white;">
                    <h5 class="modal-title">Editar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style="color:white;" aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="box-body">

                        <!--Entrada nombre-->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre"
                                    value="" required>
                            </div>
                        </div>

                        <!--Entrada usuario-->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-key"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario"
                                    value="Ingresar usuario" readonly>
                            </div>
                        </div>

                        <!--Entrada contraseña-->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                </div>
                                <input type="password" class="form-control input-lg" name="editarPassword"
                                    placeholder="Escriba la nueva contraseña">

                                <input type="hidden" id="passwordActual" name="passwordActual">

                            </div>
                        </div>

                        <!--Entrada seleccionar perfil-->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-users"></i>
                                    </span>
                                </div>
                                <select class="form-control input-lg" name="editarPerfil">
                                    <option value="" id="editarPerfil"></option>
                                    <option value="Administrador">Administrador</option>
                                    <option value="Especial">Especial</option>
                                    <option value="Vendedor">Vendedor</option>
                                </select>
                            </div>
                        </div>

                        <!--Entrada subir foto-->
                        <div class="form-group">
                            <div class="panel">SUBIR FOTO</div>
                            <input type="file" class="nuevaFoto" name="editarFoto">
                            <p class="help-block">Peso máximo de la foto 5 mb</p>
                            <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar"
                                width="100px">
                            <input type="hidden" name="fotoActual" id="fotoActual">
                        </div>

                    </div>
                </div>

                <!-- Pie modal -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar cambios</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                </div>

                <?php

                $editarUsuario = new ControladorUsuarios();
                $editarUsuario->ctrEditarUsuario();

                ?>

            </form>
        </div>

    </div>

</div>

<?php 
    $borrarUsuario = new ControladorUsuarios();
    $borrarUsuario->ctrBorrarUsuario();
?>