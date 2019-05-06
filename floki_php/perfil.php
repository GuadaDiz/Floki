<?php

require("funciones.php");
if (!usuarioLogueado()) {
    header("Location:home.php");
}
$usuario = traerUsuarioLogueado();



if ($_POST) {
    $errores = validarPerfil($_POST);

    if (empty($errores)) {
        actualizarUsuario($_POST);
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
                        <?php if (isset($errores["nombre"])) : ?>
                            <input class="form-control" type="text" name="nombre" value="<?= $_SESSION["nombre"] ?>">
                            <div>
                                <small class="text-muted">
                                    <?= $errores["nombre"] ?>
                                </small>
                            </div>
                        <?php elseif (isset($_POST["nombre"])) : ?>
                            <input class="form-control" type="text" name="nombre" value="<?= $_POST["nombre"] ?>">
                        <?php elseif (isset($_SESSION["nombre"])) : ?>
                            <input class="form-control" type="text" name="nombre" value="<?= $_SESSION["nombre"] ?>">
                        <?php endif ?>
                    </div>
                    <div>
                    <label for="apellido">Apellido</label>
                        <?php if (isset($errores["apellido"])) : ?>
                            <input class="form-control" type="text" name="apellido" value="<?= $_SESSION["apellido"] ?>">
                            <div>
                                <small class="text-muted">
                                    <?= $errores["apellido"] ?>
                                </small>
                            </div>
                        <?php elseif (isset($_POST["apellido"])) : ?>
                            <input class="form-control" type="text" name="apellido" value="<?= $_POST["apellido"] ?>">
                        <?php elseif (isset($_SESSION["apellido"])) : ?>
                            <input class="form-control" type="text" name="apellido" value="<?= $_SESSION["apellido"] ?>">
                        <?php endif ?>
                    </div>

                    <div>
                        <div> <label for="cumple">Cumpleaños</label></div>
                        <?php if (isset($errores["cumple"])) : ?>
                            <input class="form-control" ttype="date" name="cumple" min="1910-01-01" value="<?= $_SESSION["cumple"] ?>">
                            <div>
                                <small class="text-muted">
                                    <?= $errores["cumple"] ?>
                                </small>
                            </div>
                        <?php elseif (isset($_POST["cumple"])) : ?>
                            <input class="form-control" type="date" name="cumple" min="1910-01-01" value="<?= $_POST["cumple"] ?>">
                        <?php else : ?>
                            <input class="form-control" type="date" name="cumple" min="1910-01-01" value="<?php echo date("Y-m-d") ?>">
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
</body>

</html>