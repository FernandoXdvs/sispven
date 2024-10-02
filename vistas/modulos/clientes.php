<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Administrar clientes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="inicio">
                                Inicio
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Administrar clientes</li>
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

                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCliente">
                    Agregar cliente
                </button>

            </div>

            <div class="card-body">

                <table class="table table-bordered table-striped tablaClientes">
                    <thead>
                        <tr style="width: 10px;">
                            <th>#</th>
                            <th>Nombre</th>
                            <th>INE/IFE</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Total compras</th>
                            <th>Última compra</th>
                            <th>Ingreso sistema</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $item = null;
                        $valor = null;
                        $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

                        foreach ($clientes as $key => $cliente) {
                            echo '<tr>
                            <td>' . ($key + 1) . '</td>
                            <td>' . $cliente['nombre'] . '</td>
                            <td>' . $cliente['documento'] .
                                ' <br>
                            <small><b>Fecha Nacimiento : </b>' . $cliente['fecha_nacimiento'] . '</small>
                            </td>
                            <td>' . $cliente['email'] . '</td>
                            <td>' . $cliente['telefono'] . '</td>
                            <td>' . $cliente['direccion'] . '</td>
                            <td>' . $cliente['compras'] . '</td>
                            <td>' . "0000-00-00 00:00:00" . '</td>
                            <td>' . $cliente['fecha'] . '</td>
                            <td>
                                <div class="btn-group">
                                   <button class="btn btn-warning btnEditarCliente" data-toggle="modal" 
                                     data-target="#modalEditarCliente" idCliente="' . $cliente['id'] . '"><i class="fa fa-pen"></i></button>
                                <button class="btn btn-danger btnEliminarCliente" idCliente="' . $cliente['id'] . '"><i class="fa fa-times"></i></button>
                               </div>
                            </td>
                           </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<!--==========================================
===========MODAL AGREGAR CLIENTE============== 
===========================================-->
<div id="modalAgregarCliente" class="modal fade" role="dialog">

    <!--Modal--->
    <div class="modal-dialog">

        <div class="modal-content">

            <!--Formulario-->
            <form role="form" method="post">

                <div class="modal-header" style="background: #3c8dbc; color: white;">
                    <h5 class="modal-title">Agregar cliente</h5>
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
                                <input type="text" class="form-control input-lg" name="nuevoCliente"
                                    placeholder="Ingresar nombre" required>
                            </div>
                        </div>

                        <!--Entrada INE/IFE-->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-key"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control input-lg" name="nuevoDocumentoId"
                                    placeholder="Ingresar INE o IFE" required>
                            </div>
                        </div>

                        <!--Entrada email-->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                </div>
                                <input type="email" class="form-control input-lg" name="nuevoEmail"
                                    placeholder="Ingresar email" required>
                            </div>
                        </div>

                        <!--Entrada telefono-->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-phone"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control input-lg" name="nuevoTelefono"
                                    placeholder="Ingresar telefóno" data-inputmask='"mask": "(999) 999-9999"' data-mask
                                    required>
                            </div>
                        </div>


                        <!--Entrada dirección-->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-map-marker"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control input-lg" name="nuevaDireccion"
                                    placeholder="Ingresar dirección" required>
                            </div>
                        </div>

                        <!--Entrada fecha nacimiento-->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control input-lg" name="nuevaFechaNacimiento"
                                    placeholder="Ingresar fecha de nacimiento" data-inputmask-alias="datetime"
                                    data-inputmask-inputformat="yyyy/mm/dd" data-mask required>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar cliente</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                </div>


                <?php
                $crearCliente = new ControladorClientes();
                $crearCliente->ctrCrearCliente();
                ?>

            </form>
        </div>

    </div>

</div>

<!--==========================================
===========MODAL EDITAR CLIENTE============== 
===========================================-->
<div id="modalEditarCliente" class="modal fade" role="dialog">

    <!--Modal--->
    <div class="modal-dialog">

        <div class="modal-content">

            <!--Formulario-->
            <form role="form" method="post">

                <div class="modal-header" style="background: #3c8dbc; color: white;">
                    <h5 class="modal-title">Editar cliente</h5>
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
                                <input type="text" class="form-control input-lg" name="editarCliente" id="editarCliente"
                                    required>
                                <input type="hidden" id="idCliente" name="idCliente">
                            </div>
                        </div>

                        <!--Entrada INE/IFE-->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-key"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control input-lg" name="editarDocumentoId"
                                    id="editarDocumentoId" required>
                            </div>
                        </div>

                        <!--Entrada email-->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                </div>
                                <input type="email" class="form-control input-lg" name="editarEmail" id="editarEmail"
                                    required>
                            </div>
                        </div>

                        <!--Entrada telefono-->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-phone"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control input-lg" name="editarTelefono"
                                    id="editarTelefono" data-inputmask='"mask": "(999) 999-9999"' data-mask required>
                            </div>
                        </div>


                        <!--Entrada dirección-->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-map-marker"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control input-lg" name="editarDireccion"
                                    id="editarDireccion" required>
                            </div>
                        </div>

                        <!--Entrada fecha nacimiento-->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control input-lg" name="editarFechaNacimiento"
                                    id="editarFechaNacimiento" data-inputmask-alias="datetime"
                                    data-inputmask-inputformat="yyyy/mm/dd" data-mask required>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar cambios</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                </div>


                <?php

                $editarCliente = new ControladorClientes();
                $editarCliente->ctrEditarCliente();

                ?>

            </form>
        </div>

    </div>

</div>

<?php
$eliminarCliente = new ControladorClientes();
$eliminarCliente->ctrEliminarCliente();
?>