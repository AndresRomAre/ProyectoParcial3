<?php

session_start();

?>
<!DOCTYPE html>
<html>

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

  <title>HELPI</title>
  <link href="assets/style-Index.css" rel="stylesheet" type="text/css" />
  <link href="https://www.dafontfree.net/embed/bXVzZW8tc2xhYi01MDAmZGF0YS80MS9tLzk1MTE2L011c2VvX1NsYWJfNTAwLm90Zg" rel="stylesheet" type="text/css" />
</head>

<body>
  <div class="container">
    <h1 class="tipografia justify-content-center d-flex">
      HELPI
    </h1>
  </div>
  <div class="container justify-content-center d-flex">
    <img src="assets/Imagenes/logo2.png" class="logo" alt="Logo">
  </div>
  <div class="container justify-content-center d-flex">
    <?php if (isset($_GET['message'])) : ?>
      <div class="alert alert-info alert-dismissible fade show rounded-0 mb-0 shadow" role="alert">
        <?= $_GET['message'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>
    <form action="ingresar.php" method="POST" style="padding-top: 2em;">
      <div class="mb-3">
        <input type="email" class="form-control input-ingreso" id="Email" name="email" placeholder="Email">
      </div>
      <div class="mb-3">
        <input type="password" class="form-control input-ingreso" id="contrasenia" name="pass" placeholder="Contraseña">
      </div>
      <div>
        <button type="submit" class="btn btn-primary btn-ingresar">
          <span class="letra-botones">
            Ingresar
          </span>
        </button>
      </div>
      <div>
        <a href="crearCuenta.php" class="btn btn-primary btn-crear">
          <span class="letra-botones">
            Crear cuenta
          </span>
        </a>

      </div>

    </form>
  </div>






  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</body>

</html>