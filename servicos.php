<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Carousel Template · Bootstrap v5.1</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/carousel/">

    <!-- Bootstrap core CSS -->
  <link href="bootstrap-5.1.3-dist/css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="css/features.css">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>


  </head>
  <body>
    <?php require_once("navbar.php") ?>
<main>

<div class="container px-4 py-5" id="featured-3">
    <h2 class="pb-2 border-bottom">Nossos principais Serviços</h2>
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
      <div class="feature col">
        <div class="feature-icon bg-primary bg-gradient">
          <svg class="bi" width="1em" height="1em"><use xlink:href="#collection"/></svg>
        </div>
        <h2>Banho</h2>
        <p>O banho varia de acordo com o porte do animal, verificar valores e tamanhos.</p>
        <a href="#" class="icon-link">
          Agendar
          <svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"/></svg>
        </a>
      </div>
      <div class="feature col">
        <div class="feature-icon bg-primary bg-gradient">
          <svg class="bi" width="1em" height="1em"><use xlink:href="#people-circle"/></svg>
        </div>
        <h2>Banho e Tosa</h2>
        <p>Assim como o banho, o banho e tosa varia de acordo com o animal, consulte os valores.</p>
        <a href="#" class="icon-link">
          Agendar
          <svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"/></svg>
        </a>
      </div>
      <div class="feature col">
        <div class="feature-icon bg-primary bg-gradient">
          <svg class="bi" width="1em" height="1em"><use xlink:href="#toggles2"/></svg>
        </div>
        <h2>Taxi Pet</h2>
        <p>Buscamos e entregamos o seu pet em casa para sua maior comodidade. Os valores variam com a distância da loja até a sua residência.</p>
        <a href="#" class="icon-link">
          Chamar Taxi Pet
          <svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"/></svg>
        </a>
      </div>
    </div>
  </div>

    <hr class="featurette-divider">

    <!-- /END THE FEATURETTES -->

  </div><!-- /.container -->

  <?php require_once("footer.php") ?>


    <script src="bootstrap-5.1.3-dist/js/bootstrap.js"></script>

      
  </body>
</html>
