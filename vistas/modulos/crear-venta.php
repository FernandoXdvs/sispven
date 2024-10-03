<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Crear venta</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="inicio">
                                Inicio
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Crear venta</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!--Formulario-->
            <div class="col-xs-12 col-md-5">
                <div class="card card-success card-outline direct-chat direct-chat-success shadow-sm">
                    <div class="card-header whith-border">

                    </div>
                    <form method="post">
                        <div class="card-body">

                            <div class="card" style="padding: 10px;;">
                                <!--Entrada del vendedor-->
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-user"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="nuevoVendedor" name="nuevoVendedor"
                                            value="Usuario Administrador" readonly>
                                    </div>
                                </div>

                                <!--Entrada registro venta-->
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-key"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta"
                                            value="123654845" readonly>
                                    </div>
                                </div>

                                <!--Entrada del cliente-->
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-users"></i>
                                            </span>
                                        </div>
                                        <select class="form-control" id="seleccionarCliente" name="seleccionarCliente"
                                            required>
                                            <option value="">Seleccionar clientes</option>
                                        </select>

                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <button type="button" class="btn btn btn-secondary btn-xs"
                                                    data-toggle="modal" data-target="#modalAgregarCliente"
                                                    data-dismiss="modal">
                                                    Agregar cliente
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!--Entrada agregar productos-->
                                <div class="form-group row nuevoProducto">

                                    <div class="col-md-6" style="padding-right:0px">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <button type="button" class="btn btn btn-danger btn-xs">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="agregarProducto"
                                                name="agregarProducto" placeholder="Descripción del producto" required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <input type="number" class="form-control" id="nuevaCantidadProducto"
                                            name="nuevaCantidadProducto" min="1" placeholder="0" required>
                                    </div>

                                    <div class="col-md-3" style="padding-left: 0px;">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-dollar-sign"></i>
                                                </span>
                                            </div>

                                            <input type="number" class="form-control" min="1" id="nuevoPrecioProducto"
                                                name="nuevoPrecioProducto" placeholder="000000" readonly required>
                                        </div>
                                    </div>

                                </div>

                                <!--Boton agregart producto-->
                                <button type="button" class="btn btn-default d-md-none">Agregar producto</button>
                                <hr>

                                <div class="row">
                                    <div class="col-md-8 offset-4">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Impuestos</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="width:50%;">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="fa fa-percent"></i>
                                                                </span>
                                                            </div>
                                                            <input type="number" class="form-control" min="0"
                                                                id="nuevoImpuestoVenta" name="nuevoImpuestoVenta"
                                                                placeholder="0" value="0" required>
                                                        </div>
                                                    </td>

                                                    <td style="width:50%;">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="fa fa-dollar-sign"></i>
                                                                </span>
                                                            </div>
                                                            <input type="number" class="form-control" min="0"
                                                                id="nuevoTotalVenta" name="nuevoTotalVenta"
                                                                placeholder="0" value="0" readonly>
                                                        </div>
                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!--Metodo de pago-->
                                <div class="row form-group">
                                    <div class="col-md-7" style="padding-right:3px;">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-cash-register"></i>
                                                </span>
                                            </div>
                                            <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago"
                                                required>
                                                <option value="">Seleccione método de pago</option>
                                                <option value="efectivo">Efectivo</option>
                                                <option value="tarjetaCredito">Tarjeta Crédito</option>
                                                <option value="tarjetaDebito">Tarjeta Débito</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5" style="padding-left:0;">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-lock"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="nuevoCodigoTransaccion"
                                                name="nuevoCodigoTransaccion" placeholder="Código transacción" required>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-success">Agregar venta</button>
                        </div>
                    </form>
                </div>
            </div>
            <!--Tabla con productos-->
            <div class="col-md-7 hidden-sm hidden-xs">
                <div class="card card-info card-outline direct-chat direct-chat-success shadow-sm">
                    <hr>
                    <div class="card-body" style="margin: 0px 5px 0px 5px;">
                        <table class="table table-bordered table-striped dt-responsive tablas">
                            <thead>
                                <tr>
                                    <th style="widht:10px;">#</th>
                                    <th>Imagen</th>
                                    <th style="widht:15px;">Código</th>
                                    <th>Descripción</th>
                                    <th>Categoría</th>
                                    <th style="widht:15px;">Stock</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <td>1</td>
                                <td><img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                                <td>102</td>
                                <td>Plato Flotante para Allanadora</td>
                                <td>EQUIPOS ELECTROMECÁNICOS</td>
                                <td>20</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-xs">Agregar</button>
                                </td>
                            </tbody>
                        </table>
                    </div>
                </div>
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