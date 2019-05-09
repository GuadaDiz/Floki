<?php
  require "funciones.php";

  if(!usuarioLogueado()){
    header("Location:home.php");
    exit;
  }
  $usuarios = listaDeUsuarios();  
  $usuario = traerUsuarioLogueado();
?>
<html lang="en" dir="ltr">

<head>
    <?php include("head.php") ?>
    <title>Lista usuarios</title>
</head>

<body>
    <!-- header -->
    <?php include("header.php") ?>

    <div class="row">
        <div class="col">
          <h2>Registro de usuarios</h2>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Email</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($usuarios as $datos): ?>
              <tr>
                <td><?= $datos["id"] ?></td>
                <td><?= $datos["nombre"] ?></td>
                <td><?= $datos["apellido"] ?></td>
                <td><?= $datos["email"] ?></td>
                <td><a class="btn btn-primary btn-sm" href="<?= 'edit.php?id=' . $datos["id"] ?>">Editar</a></td>
              </tr>
            <?php endforeach; ?>
            </tbody>

          </table>
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
