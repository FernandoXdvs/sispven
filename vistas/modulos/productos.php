<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Administrar Productos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="inicio">
                                Inicio
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Administrar Productos</li>
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

                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">
                    Agregar producto
                </button>

            </div>

            <div class="card-body">

                <table class="table table-bordered table-striped tablaProductos">

                    <thead>
                        <tr style="width: 10px;">
                            <th>#</th>
                            <th>Imagen</th>
                            <th>Código</th>
                            <th>Descripción</th>
                            <th>Categoría</th>
                            <th>Stock</th>
                            <th>Precio de compra</th>
                            <th>Precio de venta</th>
                            <th>Ventas</th>
                            <th>Agregado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
</div>

<!--==========================================
===========MODAL AGREGAR PRODICTO============== 
===========================================-->
<div id="modalAgregarProducto" class="modal fade" role="dialog">

    <!--Modal--->
    <div class="modal-dialog">

        <div class="modal-content">

            <!--Formulario-->
            <form role="form" method="post" enctype="multipart/form-data">

                <div class="modal-header" style="background: #3c8dbc; color: white;">
                    <h5 class="modal-title">Agregar Prodcuto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style="color:white;" aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="box-body">

                        <!--Entrada seleccionar categoria-->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-th"></i>
                                    </span>
                                </div>
                                <select class="form-control input-lg" name="nuevaCategoria" id="nuevaCategoria">
                                    <option value="">Selecciona categoría</option>
                                    <?php
                                        $item =null;
                                        $valor=null;

                                        $categorias= ControladorCategorias::ctrMostrarCategorias($item, $valor);

                                        foreach ($categorias as $key => $categoria) {
                                            echo '<option value="'.$categoria['id'].'">'.$categoria['categoria'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!--Entrada codigo-->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-code"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control input-lg" id="nuevoCodigo" name="nuevoCodigo"
                                    placeholder="Ingresar código" readonly required>
                            </div>
                        </div>

                        <!--Entrada descripcion-->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-store"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control input-lg" name="nuevaDescripcion"
                                    placeholder="Ingresar descripción" required>
                            </div>
                        </div>

                        <!--Entrada stock-->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-check"></i>
                                    </span>
                                </div>
                                <input type="number" class="form-control input-lg" name="nuevoStock" min="0"
                                    placeholder="Ingresar stock" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-xs-12 col-md-6" style="margin-top:7px;">
                                <!--Entrada precio compra-->
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-arrow-up"></i>
                                        </span>
                                    </div>
                                    <input type="number" class="form-control input-lg"  id="nuevoPrecioCompra" name="nuevoPrecioCompra" min="0"
                                        placeholder="Precio de compra" step="any" required>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6" style="margin-top:7px;">
                                <!--Entrada precio venta-->
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-arrow-down"></i>
                                        </span>
                                    </div>
                                    <input type="number" class="form-control input-lg" id="nuevoPrecioVenta" name="nuevoPrecioVenta" min="0"
                                        placeholder="Precio de venta" step="any" required>
                                </div>

                                <br>
                                <!--Entrada para porcentaje-->
                                <div class="col-md-12" style="margin-bottom: 5px;">
                                    <div class="input-group">
                                        <input type="number" class="form-control input-lg nuevoPorcentaje" min="0"
                                            value="40" required>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-percent"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <!--Checkbox para porcentaje-->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="checkboxPrimary1" class="minimal porcentaje"
                                                checked>
                                            <label for="checkboxPrimary1">Utilizar porcentaje</label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>



                        <!--Entrada subir foto-->
                        <div class="form-group">
                            <div class="panel">SUBIR IMAGEN</div>
                            <input type="file" id="nuevaImagen" name="nuevaImagen">
                            <p class="help-block">Peso máximo de la foto 5 mb</p>
                            <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="100px">
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar producto</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                </div>
            </form>
            <?php 
                $crearProducto = new ControladorProductos();
                $crearProducto -> ctrCrearProducto();
                                        
            ?>

        </div>

    </div>

</div>