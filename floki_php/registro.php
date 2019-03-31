<!DOCTYPE html>
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
                <form class="formulario-registro" action="index.html" method="post">
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
                        <input class="userform" id="nombre" type="text" name="nombre" value="" placeholder="Nombre" required />
                    </p>
                    <p>
                        <input class="userform" id="apellido" type="text" name="apellido" value="" placeholder="Apellido" required />
                    </p>
                    <p>
                        <input class="userform" id="email" type="email" name="email" value="" placeholder="Email" required />
                    </p>
                    <p>
                        <input class="userform" id="contraseña" type="password" name="contraseña" value="" placeholder="Contraseña" required />
                    </p>
                    <p>
                        <input class="userform" id="repitacontraseña" type="password" name="contraseña" value="" placeholder="Repita su contraseña" required />
                    </p>

                    <p>
                        <label for="t&c"></label>
                        <input class="tyc" type="checkbox" name="" value="novedades" />
                        Deseo recibir novedades en mi email.
                        <br />
                        <input class="tyc" type="checkbox" name="" value="t&c" required />
                        Estoy de acuerdo con los términos y condiciones.
                    </p>
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
</body>

</html> 