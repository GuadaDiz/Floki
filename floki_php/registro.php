<?php

require("funciones.php");



if ($_POST) {
    // validar datos del form
    $errores = validar($_POST);

    if (empty($errores)) {
        $usuario = armarUsuario($_POST);
        guardarUsuario($usuario);
        header("Location:home.php");
    }
}
?>

<html lang="en" dir="ltr">

<head>
    <?php include("head.php") ?>
    <title>¡Registrate!</title>
</head>

<body>
    <!--HEADER-->
    <?php include("header.php") ?>
    <!--SECTION-->
    <section class="section-registro">
        <div class="register">
            <!--Imagen-->
            <article class="art1 d-none d-lg-block">
                <img src="images/living.jpg" alt="living" width="100%" height="859px" />
            </article>
            <!--Form-->
            <article class="art2">
                <form class="formulario-registro" action="registro.php" method="post">
                    <p class="registrate">
                        ¡Registrate!
                    </p>
                    <div class="registrarsecon">
                        <article class="reg">
                            <i class="fab fa-google-plus-g"></i>
                        </article>
                        <article class="reg">
                            <i class="fab fa-facebook-f"></i>
                        </article>
                        <article class="reg">
                            <i class="fab fa-twitter"></i>
                        </article>
                    </div>
                    <div class="o-wrap2">
                        <hr />
                        <i class="far fa-circle"></i>
                    </div>
                    <p>
                        <?php if (isset($errores["nombre"])) : ?>
                            <input class="userform" id="nombre" type="text" name="nombre" value="" placeholder="<?= $errores["nombre"] ?>" />
                        <?php elseif (isset($_POST["nombre"])) : ?>
                            <input class="userform" id="nombre" type="text" name="nombre" value="<?= $_POST["nombre"] ?>" />
                        <?php else : ?>
                            <input class="userform" id="nombre" type="text" name="nombre" placeholder="Nombre" />
                        <?php endif ?>
                    </p>
                    <p>
                        <?php if (isset($errores["apellido"])) : ?>
                            <input class="userform" id="apellido" type="text" name="apellido" value="" placeholder="<?= $errores["apellido"] ?>" />
                        <?php elseif (isset($_POST["apellido"])) : ?>
                            <input class="userform" id="apellido" type="text" name="apellido" value="<?= $_POST["apellido"] ?>" />
                        <?php else : ?>
                            <input class="userform" id="apellido" type="text" name="apellido" placeholder="apellido" />
                        <?php endif ?>
                    </p>
                    <p>
                        <?php if (isset($errores["email"])) : ?>
                            <input class="userform" id="email" type="name" name="email" value="" placeholder="<?= $errores["email"] ?>" />
                        <?php elseif (isset($_POST["email"])) : ?>
                            <input class="userform" id="email" type="text" name="email" value="<?= $_POST["email"] ?>" />
                        <?php else : ?>
                            <input class="userform" id="email" type="text" name="email" placeholder="email" />
                        <?php endif ?>
                    </p>
                    <p>
                        <?php if (isset($errores["pass"])) : ?>
                            <input class="userform" id="contraseña lefttip" type="password" name="pass" value="" data-toggle="tooltip" data-placement="top" title="Al menos 8 caracteres, una mayúscula, una minúscula y un número." placeholder="<?= $errores["pass"] ?>" />
                        <?php elseif (isset($_POST["pass"])) : ?>
                            <input class="userform" id="contraseña lefttip" type="password" name="pass" value="" data-toggle="tooltip" data-placement="top" title="Al menos 8 caracteres, una mayúscula, una minúscula y un número." placeholder="Las contraseñas no coinciden" />
                        <?php else : ?>
                            <input class="userform tooptip-pass" id="contraseña lefttip" type="password" name="pass" value="" data-toggle="tooltip" data-placement="top" title="Al menos 8 caracteres, una mayúscula, una minúscula y un número." placeholder="Contraseña" />
                        <?php endif ?>


                    </p>
                    <p>
                        <?php if (isset($errores["pass2"])) : ?>
                            <input class="userform" id="repitacontraseña" type="password" name="pass2" value="" placeholder="<?= $errores["pass2"] ?>" />
                        <?php else : ?>
                            <input class="userform" id="repitacontraseña" type="password" name="pass2" value="" placeholder="Repita su contraseña" />
                        <?php endif ?>
                    </p>

                    <p>
                        <div><input class="tyc" type="checkbox" name="news" value="novedades" />
                            Deseo recibir novedades en mi email.</div>
                        <div>
                            <?php if (isset($errores["tyc"])) : ?>
                                <input class="tyc" type="checkbox" name="tyc" value="t&c" />
                                Estoy de acuerdo con los <a href="">términos y condiciones.</a>
                                <div><small class="text-muted">Acepte los terminos y condiciones para continuar</small></div>
                            <?php elseif (isset($_POST["tyc"])) : ?>
                                <input class="tyc" type="checkbox" name="tyc" value="t&c" checked />
                                Estoy de acuerdo con los <a href="">términos y condiciones.</a>
                            <?php else : ?>
                                <input class="tyc" type="checkbox" name="tyc" value="t&c" />
                                Estoy de acuerdo con los <a href="">términos y condiciones.</a>
                            <?php endif ?>
                        </div>
                        <p>
                            <button id="send-button" type="submit" name="button">
                                <i class="far fa-paper-plane"></i> Enviar
                            </button>
                        </p>
                </form>
            </article>
        </div>
    </section>
    <!-- FOOTER -->
    <?php include("footer.php") ?>

    <!--SCRIPTS-->
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