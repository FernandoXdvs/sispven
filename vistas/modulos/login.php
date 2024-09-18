<div id="back"></div>

<!-- /.login-logo -->
<div class="content-login">
    <div class="login-box">
        <div class="login-logo">
            <a href="inicio">
                <img src="vistas/img/plantilla/logo.png" style="width: 70%;" class="img-responsive mb-1">
            </a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Ingresar al sistema</p>

                <form method="post">

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="ingPassword" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Recuerdame
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-success btn-block">Ingresar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                    <?php
                    $login = new ControladorUsuarios();
                    $login->ctrIngresoUsuario();
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>