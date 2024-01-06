<?php
    require "clases/Conexion.php";

    $obj = new conectar();
    $conexion = $obj->conexion();

    $sql = "SELECT * FROM usuarios WHERE email = 'admin'";
    $result = mysqli_query($conexion, $sql);
    $validar = (mysqli_num_rows($result) > 0) ? 1 : 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login de usuario</title>
    <link rel="stylesheet" href="librerias/bootstrap/css/bootstrap.css">
    <script src="librerias/jquery-3.2.1.min.js"></script>
    <script src="js/funciones.js"></script>
</head>
<body>
    <br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">Sistema de ventas y almacen</div>
                    <div class="panel-body">
                        <p><img src="img/Logo.jpeg" height="190"></p>
                        <form id="frmLogin" autocomplete="off">
                            <label>Usuario</label>
                            <input type="text" class="form-control input-sm" name="usuario" id="usuario">
                            <label>Password</label>
                            <input type="password" name="password" id="password" class="form-control input-sm">
                            <p></p>
                            <span class="btn btn-primary btn-sm" id="entrarSistema">Entrar</span>
                            <?php if (!$validar): ?>
                                <a href="registro.php" class="btn btn-danger btn-sm">Registrar</a>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#entrarSistema').click(function () {
                vacios = validarFormVacio('frmLogin');

                if (vacios > 0) {
                    alert("Debes llenar todos los campos");
                    return false;
                }

                datos = $('#frmLogin').serialize();
                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "procesos/regLogin/login.php",
                    success: function (r) {
                        if (r == 1) {
                            window.location = "vistas/inicio.php";
                        } else {
                            alert("No se pudo acceder");
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
