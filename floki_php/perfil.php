<?php

require("classes/init.php");
if (!$auth->usuarioLogueado()) {
    header("Location:home.php");
}
$usuario = $auth->traerUsuarioLogueado();

if ($_POST) {

    $errores = Validator::validarPerfil($_POST);
    
    if (empty($errores)) {
        $usuario->setNombre($_POST["nombre"]);
        $usuario->setApellido($_POST["apellido"]);
        $usuario->setTelefono($_POST["telefono"]);
        $usuario->setCumple($_POST["cumple"]);

        $dbMysql->actualizarUsuario($usuario);
    };
}
// if ($_FILES) {
//     $file = null;
//     $errorAvatar = validarAvatar($_FILES);
//     if (empty($errorAvatar)) {
//         guardarAvatar($_FILES);
//     }
// }

?>

<html lang="en" dir="ltr">

<head>
    <?php include("head.php") ?>
    <title>Perfil</title>
</head>

<body>
    <!-- header -->
    <?php include("header.php") ?>

    <div class="container perfil">
        <div class="row">
            <div class="col-12 col-sm-4 ">
                <h2 class="h2perfil">cuenta</h2>
                <ul>
                    <li>
                        <a class="listperfil" href="">perfil</a>
                    </li>
                    <li>
                        <a class="listperfil" href="">historial de ordenes</a>
                    </li>
                    <li>
                        <a class="listperfil" href="">direcciones guardadas</a>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-sm-8">
                <h2 class="h2perfil">perfil</h2>
                <form action="" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="nombre">Nombre</label>
                        <input class="form-control" type="text" name="nombre" value="<?= $usuario->getNombre() ?>">
                        <?php if (isset($errores["nombre"])) : ?>
                            <div>
                                <small class="text-muted">
                                    <?= $errores["nombre"] ?>
                                </small>
                            </div>
                        <?php endif ?>
                    </div>
                    <div>
                        <label for="apellido">Apellido</label>
                        <input class="form-control" type="text" name="apellido" value="<?= $usuario->getApellido() ?>">
                        <?php if (isset($errores["apellido"])) : ?>
                            <div>
                                <small class="text-muted">
                                    <?= $errores["apellido"] ?>
                                </small>
                            </div>
                        <?php endif ?>
                    </div>
                    <div>
                        <label for="telefono">Telefono</label>
                        <input class="form-control" type="text" name="telefono" value="<?= $usuario->getTelefono() ?>">
                        <?php if (isset($errores["telefono"])) : ?>
                            <div>
                                <small class="text-muted">
                                    <?= $errores["telefono"] ?>
                                </small>
                            </div>
                        <?php endif ?>
                    </div>

                    <div>
                        <label for="cumple">Cumpleaños</label>
                        <?php if ($usuario->getCumple()!==null) :?>
                            <input class="form-control" type="date" name="cumple" min="1910-01-01" value="<?= $usuario->getCumple() ?>">
                        <?php else : ?>
                            <input class="form-control" type="date" name="cumple" min="1910-01-01" value="<?php echo date("Y-m-d") ?>">
                        <?php endif ?>
                        <?php if (isset($errores["cumple"])) : ?>
                            <div>
                                <small class="text-muted">
                                    <?= $errores["cumple"] ?>
                                </small>
                            </div>
                        <?php endif ?>
                    </div>

                    <button type="submit">Actualizar</button>
                </form>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <?php include("footer.php") ?>
    <!--  scripts de Bootstrap-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 
 <script type="text/javascript">
        $(document).ready(function() {
            $("#lefttip").tooltip({
                placement: "left"
            });
        });
    </script>

</body>

</html>