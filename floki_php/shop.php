<html lang="en" dir="ltr">

<?php include("productos.php") ?>

<head>
    <?php include("head.php") ?>
    <title>FLOKI Deco & Design</title>

</head>

<body>
    <!-- header -->
    <?php include("header.php") ?>
    <!-- carrusel 1 -->

<div class="container-fluid" >

<section class="container-fluid">
<div class="row">

  <?php foreach($productos as $key=>$value): ?>
    <?php if ($_GET["categoria"] == $value["categoria"]): ?>
      <?php $producto = $value["codigo"]; ?>
    <article class="col-lg-3 col-md-4 col-sm-6 col-xs-6 shop-articulo">
      <a href=<?php echo "producto.php?codigo=".$producto  ?>><img  src=<?php echo $value["url-fotos"][0]; ?> alt="<?php echo $value["titulo"]; ?>"></a>

      <a href=<?php echo "producto.php?codigo=".$producto  ?>>
        <p><?php echo $value["titulo"]; ?></p></a>
        
      <p><?php echo $value["precio"]; ?></p>
    </article>
      <?php endif; ?>
    <?php endforeach; ?>


</div>
</section>

<div class="banner-shop"><img class="banner" src="images/productos/banner-shop-floki.jpg" alt="Envio gratis">
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
