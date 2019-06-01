<?php
require("classes/init.php");

if($auth->usuarioLogueado()){
    header("Location:home.php");
}

if ($_POST) {
    // validar datos del form
    $errores = Validator::validarLogin($_POST);

    if (empty($errores)) {
        if(isset($_POST["recordarme"]) && $_POST["recordarme"]!=""){
            setcookie("user", $_POST["email"], time()+ 60);
        }
        $auth->loguearUsuario($_POST);
        header("Location:home.php");
    }
}
?>

<html lang="en" dir="ltr">
<head>
    <?php include("head.php") ?>
    <title>Login</title>
</head>

<body>
    <!--HEADER-->
    <?php include("header.php") ?>
    <!--SECTION-->
    <section class="section-login">
        <div class="login">
            <!--Imagen-->
            <article class="art1 d-none d-lg-block">
                <img src="images/home-office.jpg" alt="living" />
            </article>
            <!--Form-->
            <article class="art2">
                <form class="formulario-login" method="post">
                    <p class="ingresa">
                        ¡Ingresá!
                    </p>
                    <div class="ingresarcon">
                        <article class="ing">
                            <i class="fab fa-google-plus-g"></i>
                        </article>
                        <article class="ing">
                            <i class="fab fa-facebook-f"></i>
                        </article>
                        <article class="ing">
                            <i class="fab fa-twitter"></i>
                        </article>
                    </div>
                    <div class="o-wrap">
                        <hr />
                        <i class="far fa-circle"></i>
                    </div>
                    <p>
                        <?php if (isset($errores["email"])) : ?>
                            <input class="userform" id="email" type="email" name="email" placeholder="<?= $errores["email"] ?>" />
                        <?php elseif (isset($_POST["email"])) : ?>
                            <input class="userform" id="email" type="email" name="email" placeholder="<?= $_POST["email"] ?>" />
                        <?php else : ?>
                            <input class="userform" id="email" type="email" name="email" placeholder="Email" />
                        <?php endif ?>
                    </p>
                    <p>
                        <?php if (isset($errores["pass"])) : ?>
                            <input class="userform" id="contraseña" type="password" name="pass" placeholder="<?= $errores["pass"] ?>" />
                        <?php else : ?>
                            <input class="userform" id="contraseña" type="password" name="pass" placeholder="contraseña" />
                        <?php endif ?>
                    </p>
                    <p>

                        <input class="tyc" type="checkbox" name="recordarme" />
                        <label for="t&c">Recordarme</label>
                    </p>
                    <p>
                        <button id="send-button" type="submit" name="button" >
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
</body>

</html>
