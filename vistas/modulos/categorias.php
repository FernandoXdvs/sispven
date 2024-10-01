<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Administrar categorías</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="inicio">
                                Inicio
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Administrar categorías</li>
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

                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">
                    Agregar categoría
                </button>

            </div>

            <div class="card-body">

                <table class="table table-bordered table-striped  tablas">
                    <thead>
                        <tr style="width: 10px;">
                            <th>#</th>
                            <th>Categoría</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        $item = null;
                        $valor = null;

                        $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                        foreach ($categorias as $key => $categoria) {
                            echo '<tr>
                                    <td>' . ($key + 1) . '</td>
                                    <td class="text-uppercase">' . $categoria['categoria'] . '</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-warning btnEditarCategoria" idCategoria="' . $categoria['id'] . '" 
                                            data-toggle="modal" data-target="#modalEditarCategoria">
                                                <i class="fa fa-pen"></i>
                                            </button>
                                            <button class="btn btn-danger btnEliminarCategoria" idCategoria="' . $categoria['id'] . '">
                                                <i class="fa fa-times"></i>
                                            </button>
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
===========MODAL AGREGAR CATEGORIAS============== 
===========================================-->
<div id="modalAgregarCategoria" class="modal fade" role="dialog">

    <!--Modal--->
    <div class="modal-dialog">

        <div class="modal-content">

            <!--Formulario-->
            <form role="form" method="post">

                <div class="modal-header" style="background: #3c8dbc; color: white;">
                    <h5 class="modal-title">Agregar Categoría</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style="color:white;" aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="box-body">
                        <!--Entrada categoria-->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-th"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control input-lg" name="nuevaCategoria"
                                    placeholder="Ingresar categoría" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar categoría</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                </div>

                <?php

                $crearCategoria = new ControladorCategorias();
                $crearCategoria->ctrCrearCategoria();

                ?>

            </form>
        </div>

    </div>

</div>

<!--==========================================
===========MODAL EDITAR CATEGORIAS============== 
===========================================-->
<div id="modalEditarCategoria" class="modal fade" role="dialog">

    <!--Modal--->
    <div class="modal-dialog">

        <div class="modal-content">

            <!--Formulario-->
            <form role="form" method="post">

                <div class="modal-header" style="background: #3c8dbc; color: white;">
                    <h5 class="modal-title">Editar Categoría</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style="color:white;" aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="box-body">
                        <!--Entrada categoria-->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-th"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control input-lg" name="editarCategoria"
                                    id="editarCategoria" required>
                                <input type="hidden" name="idCategoria" id="idCategoria">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar cambios</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                </div>

                <?php

                $editarCategoria = new ControladorCategorias();
                $editarCategoria->ctrEditarCategoria();

                ?>

            </form>
        </div>

    </div>

</div>

<?php

$borrarCategoria = new ControladorCategorias();
$borrarCategoria->ctrBorrarCategoria();

?>