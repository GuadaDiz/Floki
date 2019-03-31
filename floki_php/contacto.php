<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <?php include("head.php") ?>
    <title>Contactanos</title>
</head>

<body>
    <!--HEADER-->
    <?php include("header.php") ?>
    <!--SECTION-->
    <section class="section-contacto">
        <div class="register">
            <!--Imagen-->
            <article class="art1 d-none d-lg-block">
                <img src="images/living2.jpg" alt="living2" width="100%" height="859px" />
            </article>
            <!--Form-->
            <article class="art2">
                <form class="formulario" action="index.html" method="post">
                    <p class="contactanos">
                        ¡Contactanos!
                    </p>
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
                        <textarea class="userform mensaje-contacto" id="mensaje" name="mensaje" value="" rows="8" cols="60" placeholder="Escriba su mensaje aquí..." required></textarea>
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